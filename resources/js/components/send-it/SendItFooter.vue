<script setup lang="ts">
const links = [
    'Privacy Policy',
    'Terms of Service',
    'Cookie Settings',
    'Instagram',
    'Twitter',
    'Contact Us',
];
</script>

<template>
    <footer class="w-full border-t border-surface-container bg-surface-container">
        <div
            class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-8 py-12 md:flex-row"
        >
            <div
                class="font-headline text-lg font-bold tracking-tighter text-slate-300 uppercase"
            >
                Send It
            </div>
            <div
                class="font-body flex flex-wrap justify-center gap-8 text-xs tracking-widest text-slate-500 uppercase"
            >
                <a
                    v-for="link in links"
                    :key="link"
                    href="#"
                    class="transition-all hover:text-primary hover:underline"
                >
                    {{ link }}
                </a>
            </div>
            <div class="font-body text-xs text-slate-500">
                &copy; 2026 Send It. Technical Alpine Equipment &amp;
                Community.
            </div>
        </div>
    </footer>
</template>
