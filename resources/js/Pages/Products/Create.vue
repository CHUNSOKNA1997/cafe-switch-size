<script setup>
import { router, useForm } from "@inertiajs/vue3";

const homeCallBack = () => {
    router.visit("/products");
};

const form = useForm({
    name: "",
    size: "",
});

const submitCreateCoffee = () => {
    form.post("/products", {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <main class="h-screen w-screen flex justify-center items-center">
        <div class="relative flex flex-col rounded-xl bg-transparent">
            <div class="flex justify-between">
                <h4 class="block text-4xl font-semibold text-slate-800">
                    Add a Coffee
                </h4>
                <button
                    @click="homeCallBack"
                    class="bg-green-500 px-4.5 py-1.5 text-white rounded-md hover:bg-green-600 transition-colors duration-300 hover:cursor-pointer"
                >
                    Back Home
                </button>
            </div>
            <form
                class="mt-8 mb-2 w-96 max-w-screen-lg sm:w-[32rem]"
                @submit.prevent="submitCreateCoffee"
            >
                <div class="mb-1 flex flex-col gap-6">
                    <div class="w-full max-w-lg min-w-[300px]">
                        <input
                            v-model="form.name"
                            type="text"
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-lg border border-slate-200 rounded-md px-4 py-4 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            placeholder="Coffee Name"
                        />
                        <div
                            v-if="form.errors.name"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.name }}
                        </div>
                    </div>

                    <div class="w-full max-w-lg min-w-[300px]">
                        <input
                            v-model="form.size"
                            type="text"
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-lg border border-slate-200 rounded-md px-4 py-4 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            placeholder="Coffee Size (eg. S, M, L)"
                        />
                        <div
                            v-if="form.errors.size"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.size }}
                        </div>
                    </div>
                </div>
                <button
                    class="mt-4 w-full rounded-md bg-green-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none hover:cursor-pointer focus:outline-none"
                    type="submit"
                >
                    Add
                </button>
            </form>
        </div>
    </main>
</template>
