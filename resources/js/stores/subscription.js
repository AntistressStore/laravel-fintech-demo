import { defineStore } from 'pinia';
import axios from 'axios';

export const useSubscriptionStore = defineStore('subscription', {
    state: () => ({
        status: 'pending',
        endsAt: null,
        loading: false,
        error: null,
        realtimeMessage: 'Ожидание обновлений...',
    }),

    // Getters для вычисляемых свойств (демонстрация реактивности)
    getters: {
        isActive: (state) => state.status === 'active',
        statusDisplay: (state) => {
            if (state.loading) return 'Обработка платежа...';
            if (state.error) return 'Ошибка!';
            return state.status.toUpperCase();
        },
    },

    actions: {
        // Асинхронный запрос для получения текущего статуса
        async fetchStatus(subscriptionId) {
            this.loading = true;
            this.error = null;
            try {
                // Использование axios для асинхронной операции
                // в реальной практике вместо url будет функция получения route с laravel
                const response = await axios.get(`/api/v1/subscriptions/${subscriptionId}`);
                this.status = response.data.data.status;
                this.endsAt = response.data.data.ends_at;
            } catch (err) {
                this.error = 'Не удалось загрузить статус подписки.';
            } finally {
                this.loading = false;
            }
        },

        // Асинхронный запрос для запуска процесса оплаты
        async initiatePayment(subscriptionId) {
            this.loading = true;
            this.error = null;
            this.status = 'processing';
            this.realtimeMessage = 'Платеж отправлен в очередь. Ожидайте Real-time обновления...';

            try {
                // Отправка запроса на конечную точку API, которая запускает Laravel Job
                await axios.post(`/api/v1/subscriptions/${subscriptionId}/charge`);
            } catch (err) {
                this.error = 'Не удалось запустить платеж.';
                this.loading = false;
            }
        },

        // Обработчик Real-time обновления (имитация Centrifugo/WebSockets)
        handleRealtimeUpdate(data) {
            if (data.status === 'success') {
                this.status = 'active';
                this.endsAt = data.ends_at;
                this.realtimeMessage = 'Подписка успешно продлена!';
            } else if (data.status === 'failed') {
                this.status = 'failed';
                this.realtimeMessage = 'Платеж отклонен. Повторите попытку.';
            }
            this.loading = false;
        }
    }
});
