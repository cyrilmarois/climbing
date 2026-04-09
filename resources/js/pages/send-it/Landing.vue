<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import SendItApexCircle from '@/components/send-it/SendItApexCircle.vue';
import SendItFinalCta from '@/components/send-it/SendItFinalCta.vue';
import SendItFooter from '@/components/send-it/SendItFooter.vue';
import SendItHero from '@/components/send-it/SendItHero.vue';
import SendItNav from '@/components/send-it/SendItNav.vue';
import SendItPerformance from '@/components/send-it/SendItPerformance.vue';
import SendItRouteForge from '@/components/send-it/SendItRouteForge.vue';
</script>

<template>
    <Head title="Send It | Beyond Limits" />

    <div
        class="font-body dark min-h-svh bg-background text-on-background selection:bg-primary selection:text-on-primary"
    >
        <SendItNav />

        <main class="pt-20">
            <SendItHero />
            <SendItPerformance />
            <SendItRouteForge />
            <SendItApexCircle />
            <SendItFinalCta />
        </main>

        <SendItFooter />
    </div>
</template>
