<template>
    <div class="p-8 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">
                Coffee Products
            </h1>
            <div v-if="products.length" class="space-y-6">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300"
                >
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-900">
                                {{ product.name }}
                            </h2>
                            <p class="text-gray-600 mt-1">
                                Selected size: {{ product.size }}
                            </p>
                        </div>
                        <div>
                            <select
                                v-model="product.size"
                                @change="onUpdateSize(product)"
                                class="bg-white border border-gray-300 text-gray-900 text-lg rounded-lg block w-28 p-2 hover:cursor-pointer"
                            >
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="text-center text-gray-500 mt-10">
                <p>No products available.</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const props = defineProps({
    products: Array,
});

const onUpdateSize = async (product) => {
    try {
        await router.post(
            "/products/update-size",
            {
                id: product.id,
                size: product.size,
            },
            {
                preserveScroll: true,
                onSuccess: () => {
                    toast("Size updated successfully!", {
                        autoClose: 3000,
                    });
                },
            }
        );
    } catch (error) {
        toast("Size updated failed!", {
            autoClose: 3000,
        });
    }
};
</script>
