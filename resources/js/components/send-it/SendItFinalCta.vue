<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { register } from '@/routes';
</script>

<template>
    <section class="relative overflow-hidden bg-background py-40">
        <div class="absolute inset-0 z-0">
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--color-primary)/10%,_transparent_60%)]"
            />
        </div>

        <div class="relative z-10 mx-auto max-w-4xl px-8 text-center">
            <h2
                class="font-headline mb-12 text-7xl leading-none font-black tracking-tighter uppercase md:text-9xl"
            >
                Start Your<br /><span class="text-primary italic">Summit</span>
            </h2>
            <div
                class="flex flex-col items-center justify-center gap-6 md:flex-row"
            >
                <Button
                    as-child
                    class="font-headline rounded-lg bg-primary-container px-12 py-6 text-2xl font-black tracking-tighter text-on-primary-container uppercase shadow-xl shadow-primary/20 hover:bg-primary-container/90 active:scale-95"
                >
                    <Link :href="register()">Join the Ascent</Link>
                </Button>
                <p
                    class="font-label hidden max-w-[200px] border-l border-outline-variant/30 pl-6 text-left text-xs tracking-widest text-slate-500 uppercase md:block"
                >
                    Join 50k+ technical climbers pushing the edge.
                </p>
            </div>
        </div>
    </section>
</template>
