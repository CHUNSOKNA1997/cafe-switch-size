<script setup>
import { router } from "@inertiajs/vue3";
</script>

<template>
    <nav
        class="bg-base-100 h-[100px] max-w-screen text-black text-lg font-semibold flex items-center"
    >
        <ul class="max-w-full flex justify-between items-center gap-4 px-8">
            <li class="hover:underline hover:text-green-500">
                <a href="#">Product</a>
            </li>

            <li class="hover:underline hover:text-green-500">
                <a href="#">Home</a>
            </li>

            <li class="hover:underline hover:text-green-500">
                <a href="#">Contact</a>
            </li>
        </ul>
    </nav>

    <main>
        <slot />
    </main>
</template>
