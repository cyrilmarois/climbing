<script setup lang="ts">
import { Box, BrainCircuit } from 'lucide-vue-next';

const rockImage =
    'https://lh3.googleusercontent.com/aida-public/AB6AXuAlBcwUIexs4OtotnVNmLbdWgkxS5UqGnJp7GMshpYIrTUwjzXsfsaPnZwFVOmvYpqBy2UYncGf-hEFJX4JZ6ygBEewuZAUnM1ewFXNC98W-HQDbRIQkq3DKeHRqRDx0uYQ_n4eaSae_jyka7WyHHwB70vQeqC0Kpx4qRSKXOk7kzx_69Xew3qQ02kVGmfGNnzbTF5hnJ74nExrBEnHb-K1OcSkJwfBW1FHS8J1dyeKfTbNt1vCjX2Bb-jVS1zw0ifMBztyW52hsh2D';
</script>

<template>
    <section id="forge" class="relative overflow-hidden bg-background py-32">
        <div
            class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-20 px-8 lg:grid-cols-2"
        >
            <div class="order-2 lg:order-1">
                <div
                    class="editorial-shadow relative aspect-square overflow-hidden rounded-xl"
                >
                    <img
                        :src="rockImage"
                        alt="Rock face with AR overlay"
                        class="h-full w-full object-cover"
                    />
                    <div
                        class="absolute inset-0 bg-primary/10 mix-blend-overlay"
                    />

                    <div
                        class="absolute top-10 left-10 rounded-lg border border-outline-variant/20 bg-surface-container/60 p-4 backdrop-blur-xl"
                    >
                        <div class="flex items-center gap-3">
                            <span
                                class="h-3 w-3 animate-pulse rounded-full bg-primary"
                            />
                            <span
                                class="font-label text-[10px] tracking-tighter uppercase"
                            >
                                Scanning...
                            </span>
                        </div>
                    </div>

                    <div
                        class="absolute right-10 bottom-10 flex flex-col gap-2"
                    >
                        <div
                            class="font-label rounded-full bg-surface-container/80 px-4 py-2 text-xs backdrop-blur-md"
                        >
                            Friction: 84%
                        </div>
                        <div
                            class="font-label rounded-full bg-surface-container/80 px-4 py-2 text-xs backdrop-blur-md"
                        >
                            Angle: -12&deg;
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2">
                <span
                    class="font-label mb-6 block text-xs tracking-[0.4em] text-primary uppercase"
                >
                    Forge Your Path
                </span>
                <h2
                    class="font-headline mb-8 text-6xl leading-[0.9] font-black tracking-tighter uppercase"
                >
                    Route<br />Forge AR
                </h2>
                <p
                    class="font-body mb-10 text-lg leading-relaxed text-slate-400"
                >
                    Scan physical rock faces with your LiDAR sensor to generate
                    digital twins. Identify microscopic holds, simulate movement
                    sequences, and upload your beta directly to the community.
                </p>

                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <Box class="mt-1 size-6 shrink-0 text-primary" />
                        <div>
                            <span
                                class="font-headline block text-xl font-bold"
                            >
                                LiDAR Point Cloud Generation
                            </span>
                            <span class="text-sm text-slate-500">
                                Millimeter-precise rock texture recreation.
                            </span>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <BrainCircuit
                            class="mt-1 size-6 shrink-0 text-primary"
                        />
                        <div>
                            <span
                                class="font-headline block text-xl font-bold"
                            >
                                AI Beta Visualization
                            </span>
                            <span class="text-sm text-slate-500">
                                Neural networks suggest the most efficient
                                movement paths.
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>
