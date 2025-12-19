<script setup>
import { onMounted } from 'vue';
import { useSubscriptionStore } from '@/stores/subscription';

// Получаем Store, используя Composition API
const store = useSubscriptionStore();
const SUBSCRIPTION_ID = 123; // Имитация ID подписки

// Логика Real-time (имитация подписки на WebSockets/Centrifugo)
const setupWebsockets = () => {
    if (store.status === 'processing' && !store.loading) {
        // Имитация: через 5 секунд после запуска процесса (initiatePayment),
        // Job выполнится, и сервер пришлет Real-time обновление через Centrifugo/WS.
        setTimeout(() => {
            store.handleRealtimeUpdate({
                status: 'success',
                ends_at: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toISOString()
            });
        }, 5000);
    }
};

const renewSubscription = () => {
    // 1. Запускаем асинхронную операцию оплаты
    store.initiatePayment(SUBSCRIPTION_ID);

    // 2. Сразу после отправки запроса запускаем имитацию ожидания WS-события
    setupWebsockets();
};

onMounted(() => {
    // Загрузка начального статуса при монтировании (асинхронная операция)
    store.fetchStatus(SUBSCRIPTION_ID);
});

</script>

<template>
  <div class="subscription-card" :class="{ 'is-active': store.isActive }">
    <h2>Статус подписки (Vue 3 Composition API)</h2>

    <div class="status-indicator">
      Текущий статус: <strong>{{ store.statusDisplay }}</strong>
    </div>

    <p v-if="store.endsAt">
      Действительна до: {{ new Date(store.endsAt).toLocaleDateString() }}
    </p>

    <div class="realtime-info">
      <small>Real-time канал:</small>
      <p class="realtime-message">{{ store.realtimeMessage }}</p>
    </div>

    <button
      @click="renewSubscription"
      :disabled="store.loading"
      class="btn btn-primary"
    >
      {{ store.loading ? 'Обработка...' : 'Продлить подписку' }}
    </button>

    <p v-if="store.error" class="error-message">{{ store.error }}</p>

  </div>
</template>


