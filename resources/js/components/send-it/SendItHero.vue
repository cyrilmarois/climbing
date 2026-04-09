<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { TrendingUp } from 'lucide-vue-next';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { register } from '@/routes';

const heroImage =
    'https://lh3.googleusercontent.com/aida-public/AB6AXuB_3FP12ZaRMrq2-yqyRTRCpDhwDiSTol0abmV1yDINhFb5WEo56rJqOnJxW44tn0VNWzRy2yAPWhtPCQMN05PcnWTzktzFWYZFz8SJrmGR1Q1aGVyrQcJd8IUhmzBXY9GUkPY0ZrDEtT8U5yWPmM2n92IRM0XnosPaGI_K4Rd1kXWdS5rlbeRiEE1q9KfRYX-SitNj2O0vmj5dDXQBV8xiMnIYEMc7YHXg9rToUZyj1unH_GxJ8j2RK8AW-OCyzgn16DFYlgWAiH-0';
</script>

<template>
    <section
        class="relative flex h-[921px] min-h-[700px] items-center overflow-hidden"
    >
        <div class="absolute inset-0 z-0">
            <img
                :src="heroImage"
                alt="Climber hanging from a massive limestone overhang at dusk"
                class="h-full w-full object-cover contrast-[1.1] grayscale-[0.2]"
            />
            <div
                class="absolute inset-0 bg-gradient-to-r from-background via-background/40 to-transparent"
            />
            <div class="grain-overlay absolute inset-0" />
        </div>

        <div class="relative z-10 mx-auto w-full max-w-7xl px-8">
            <div class="max-w-3xl">
                <Badge
                    class="font-label mb-6 rounded-sm bg-primary px-3 py-1 text-[10px] tracking-[0.2em] text-on-primary uppercase hover:bg-primary"
                >
                    Technical Alpine Equipment
                </Badge>

                <h1
                    class="font-headline mb-8 text-7xl leading-[0.85] font-black tracking-tighter text-on-background md:text-9xl"
                >
                    BEYOND<br /><span class="text-primary italic">LIMITS</span>
                </h1>

                <p
                    class="mb-10 max-w-xl text-xl leading-relaxed font-light text-slate-300 md:text-2xl"
                >
                    The ultimate data-driven interface for the technical
                    climber. Precision beta, AR route scanning, and
                    professional performance analytics.
                </p>

                <div class="flex flex-wrap gap-6">
                    <Button
                        as-child
                        class="font-headline gap-3 rounded-lg bg-primary-container px-10 py-5 text-lg font-extrabold tracking-tight text-on-primary-container uppercase hover:bg-primary-container/90 active:scale-95 [&_svg:not([class*='size-'])]:size-6"
                    >
                        <Link :href="register()">
                            Join the Ascent
                            <TrendingUp />
                        </Link>
                    </Button>

                    <Button
                        variant="outline"
                        class="font-headline rounded-lg border-outline-variant/30 bg-transparent px-10 py-5 text-lg font-bold tracking-tight text-on-surface uppercase backdrop-blur-md hover:bg-surface-container hover:text-on-surface"
                    >
                        View Gear
                    </Button>
                </div>
            </div>
        </div>
    </section>
</template>
