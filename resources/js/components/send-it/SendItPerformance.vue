<script setup lang="ts">
import { Activity, Timer, TrendingUp } from 'lucide-vue-next';
import { Card } from '@/components/ui/card';
</script>

<template>
    <section id="performance" class="bg-surface-container-lowest py-32">
        <div class="mx-auto max-w-7xl px-8">
            <div
                class="mb-16 flex flex-col items-end justify-between gap-8 md:flex-row"
            >
                <div>
                    <h2
                        class="font-headline mb-4 text-5xl font-black tracking-tighter uppercase"
                    >
                        Performance Tracking
                    </h2>
                    <p class="font-body max-w-md text-slate-500">
                        Real-time biometrics and mechanical efficiency tracking
                        for peak alpine performance.
                    </p>
                </div>
                <div class="font-label text-4xl font-bold text-primary">
                    7c+
                    <span
                        class="text-sm font-light tracking-widest text-slate-400 uppercase"
                    >
                        Peak Grade
                    </span>
                </div>
            </div>

            <div
                class="grid h-auto grid-cols-1 grid-rows-2 gap-6 md:h-[600px] md:grid-cols-4"
            >
                <!-- Dynamic Power Phase (large card) -->
                <Card
                    class="relative overflow-hidden rounded-xl border-0 bg-surface-container p-8 shadow-none md:col-span-2 md:row-span-2"
                >
                    <div class="relative z-10 flex flex-1 flex-col">
                        <div>
                            <span
                                class="font-label text-xs tracking-widest text-primary uppercase"
                            >
                                Efficiency Matrix
                            </span>
                            <h3
                                class="font-headline mt-2 text-3xl font-bold text-on-surface"
                            >
                                Dynamic Power Phase
                            </h3>
                        </div>
                        <div
                            class="mt-auto flex h-64 items-end gap-2 pt-12"
                        >
                            <div
                                class="h-[40%] w-full rounded-sm bg-primary-container/20"
                            />
                            <div
                                class="h-[60%] w-full rounded-sm bg-primary-container/40"
                            />
                            <div
                                class="h-[85%] w-full rounded-sm bg-primary-container/60"
                            />
                            <div
                                class="h-full w-full rounded-sm bg-primary-container"
                            />
                            <div
                                class="h-[70%] w-full rounded-sm bg-primary-container/70"
                            />
                        </div>
                    </div>
                    <div
                        class="pointer-events-none absolute -right-8 -bottom-8 rotate-12 opacity-10"
                    >
                        <TrendingUp class="size-52 text-primary" />
                    </div>
                </Card>

                <!-- V-Static Hold Time -->
                <Card
                    class="flex flex-col justify-between rounded-xl border-0 bg-secondary-container p-8 shadow-none"
                >
                    <Timer class="size-6 text-secondary" />
                    <div>
                        <div
                            class="font-headline text-4xl font-black text-secondary"
                        >
                            14:22
                        </div>
                        <div
                            class="font-label text-xs tracking-widest text-secondary/70 uppercase"
                        >
                            V-Static Hold Time
                        </div>
                    </div>
                </Card>

                <!-- BPM Redpoint -->
                <Card
                    class="flex flex-col justify-between rounded-xl border-0 bg-surface-container p-8 shadow-none"
                >
                    <Activity class="size-6 text-primary" />
                    <div>
                        <div
                            class="font-headline text-4xl font-black text-on-surface"
                        >
                            164
                        </div>
                        <div
                            class="font-label text-xs tracking-widest text-slate-500 uppercase"
                        >
                            BPM Redpoint Avg
                        </div>
                    </div>
                </Card>

                <!-- Session Volume (wide) -->
                <Card
                    class="flex items-center justify-between rounded-xl border-0 bg-surface-container-high p-8 shadow-none md:col-span-2"
                >
                    <div>
                        <span
                            class="font-label text-xs tracking-widest text-tertiary uppercase"
                        >
                            Route Density
                        </span>
                        <h3
                            class="font-headline text-2xl font-bold text-on-surface"
                        >
                            Session Volume
                        </h3>
                    </div>
                    <div
                        class="font-headline text-5xl font-black text-on-surface"
                    >
                        1.2k
                        <span class="text-sm font-light text-slate-400">
                            meters
                        </span>
                    </div>
                </Card>
            </div>
        </div>
    </section>
</template>
