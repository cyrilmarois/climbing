<script setup lang="ts">
import { Badge } from '@/components/ui/badge';

type Dispatch = {
    image: string;
    tag: string;
    tagVariant: 'secondary' | 'primary' | 'tertiary';
    date: string;
    title: string;
    excerpt: string;
};

const dispatches: Dispatch[] = [
    {
        image:
            'https://lh3.googleusercontent.com/aida-public/AB6AXuDmiQblz2CDkxMnMpLJ0ovXadSYSJsduZ9IsYgXmdR9y0PQ8a-OAEB76TPzkfKc4aDQIybFKZWkhH_SA8B9Z17IA_HjCRqOua56h1MjRu09d-BvO_qNSdKnTlD53BII5_HBHznrVXAKS7yIy7orWjrgINCdlTClNQ0NDSubb3EFwH2tzaEZurzOinwpYgnPImAwDa4lI3LhMH0OVVbr7eFiv9Pu0lY1tFY0qAMLs4zo3j1TKbfnva49NYVDH0ItJgbXigr5l4HgBd6E',
        tag: 'Pro Dispatch',
        tagVariant: 'secondary',
        date: 'Jan 12 • Patagonia',
        title: 'Fitz Roy: New Variant Solo Log',
        excerpt:
            'Analyzing the friction coefficients on the north face during the unexpected mid-winter heatwave...',
    },
    {
        image:
            'https://lh3.googleusercontent.com/aida-public/AB6AXuClgR2IAffiAE9aQjPwRAwIg4KUUnoIF0laU5FR7I_iozZFEDRmAuiWY9cevYwfcbGrU3kuQG23JyK0Q9Su24hdIkQaQcM34iftir2QqWYZD_B_yGicIH_n8TU_qtWg7wmYSlo2mPJQ-Y7zZtE0uFo8YzSQV2HbRDaznlXeWZUVCmLgOdHqzoH958SJRV1hNLgLbOycZJRkPBGatMEF9RAtq_-JwlL6Kaal4aGuY5Bmpnzjw3W9xCHR3IahF_sFEqA0BOp9RrncQjSK',
        tag: 'Equipment Test',
        tagVariant: 'primary',
        date: 'Jan 09 • Squamish',
        title: 'Micro-Crimp Surface Tension Report',
        excerpt:
            'Testing the new Slate-X rubber on 5.14c technical faces. Data confirms 12% better shear resistance.',
    },
    {
        image:
            'https://lh3.googleusercontent.com/aida-public/AB6AXuDOp2WRaFwnrgY1UQ9MYScGT4m4yJsLBg5b4WfZfM-MXXeU08cWhWEtqCOq6_mHKUsD0qxeIPsV0--uNkwhbQRoiHaMlCH_QLKBZ_5XZ1LsbFiXDSmx34traZFWKWL4_Ce4EkyQqz-A86uuAmoMEFStZOdEPmpx3RxzVwIBLZahmmDOviPRM6SaL6IIluqadvqw5p3DxE_nUugS367ffUOYD-dHJtZFhAWnuM3BPg9Xf6v9eJD6_FGfswQHDVhRONE1wM0_qQ41CGX9',
        tag: 'Training Science',
        tagVariant: 'tertiary',
        date: 'Jan 05 • Global',
        title: 'Altitude Recovery & VO2 Max Peaks',
        excerpt:
            'Correlation between heart rate variability and success on high-altitude technical leads.',
    },
];

const badgeClasses: Record<Dispatch['tagVariant'], string> = {
    secondary: 'bg-secondary text-on-secondary hover:bg-secondary',
    primary: 'bg-primary text-on-primary hover:bg-primary',
    tertiary: 'bg-tertiary text-on-tertiary hover:bg-tertiary',
};
</script>

<template>
    <section id="apex" class="bg-surface-container-low py-32">
        <div class="mx-auto max-w-7xl px-8">
            <div class="mb-20 text-center">
                <h2
                    class="font-headline mb-4 text-5xl font-black tracking-tighter uppercase"
                >
                    Apex Circle
                </h2>
                <p class="font-body mx-auto max-w-xl text-slate-500">
                    Direct access to the technical logs and dispatch feeds of
                    the world's elite climbers.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
                <div
                    v-for="item in dispatches"
                    :key="item.title"
                    class="group cursor-pointer"
                >
                    <div
                        class="relative mb-6 aspect-[3/4] overflow-hidden rounded-lg"
                    >
                        <img
                            :src="item.image"
                            :alt="item.title"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                        />
                        <div
                            class="absolute right-0 bottom-0 left-0 bg-gradient-to-t from-background to-transparent p-6"
                        >
                            <Badge
                                :class="[
                                    'font-label rounded-full px-3 py-1 text-[10px] font-bold uppercase',
                                    badgeClasses[item.tagVariant],
                                ]"
                            >
                                {{ item.tag }}
                            </Badge>
                        </div>
                    </div>
                    <div
                        class="font-label mb-2 text-xs tracking-widest text-slate-500 uppercase"
                    >
                        {{ item.date }}
                    </div>
                    <h3
                        class="font-headline text-2xl font-bold transition-colors group-hover:text-primary"
                    >
                        {{ item.title }}
                    </h3>
                    <p class="mt-4 line-clamp-2 text-slate-400">
                        {{ item.excerpt }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
