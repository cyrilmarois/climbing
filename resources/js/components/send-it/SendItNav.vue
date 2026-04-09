<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { login, register } from '@/routes';
</script>

<template>
    <nav
        class="fixed top-0 z-50 w-full bg-[#0e1419]/70 backdrop-blur-xl transition-all duration-300"
    >
        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-8 py-4"
        >
            <div
                class="font-headline text-2xl font-black tracking-tighter text-primary"
            >
                Send It
            </div>

            <div
                class="font-headline hidden items-center gap-10 text-sm tracking-tight uppercase md:flex"
            >
                <a
                    href="#performance"
                    class="text-slate-400 transition-colors hover:text-primary"
                >
                    Features
                </a>
                <a
                    href="#apex"
                    class="text-slate-400 transition-colors hover:text-primary"
                >
                    Community
                </a>
                <a
                    href="#forge"
                    class="text-slate-400 transition-colors hover:text-primary"
                >
                    Events
                </a>
            </div>

            <div class="flex items-center gap-6">
                <Link
                    :href="login()"
                    class="font-headline text-sm tracking-tight text-slate-400 uppercase transition-colors hover:text-primary"
                >
                    Sign In
                </Link>
                <Button
                    as-child
                    class="font-headline bg-primary-container px-6 py-2 text-sm font-bold tracking-wider text-on-primary uppercase hover:bg-primary-container/80 active:scale-95"
                >
                    <Link :href="register()"> Join </Link>
                </Button>
            </div>
        </div>
    </nav>
</template>
