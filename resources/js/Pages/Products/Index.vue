<template>
    <div class="p-8 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto mt-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    List Of Coffees
                </h1>
                <button
                    @click="createCallBack"
                    class="bg-green-500 px-4.5 py-1.5 text-white rounded-md hover:bg-green-600 transition-colors duration-300 hover:cursor-pointer"
                >
                    Add
                </button>
            </div>
            <div v-if="products.length" class="space-y-6">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="bg-white p-6 rounded-lg"
                >
                    <div class="flex justify-between items-center">
                        <div class="flex justify-center items-center">
                            <!-- <img
                                :src="product.image_url"
                                alt="product_img"
                                class="h-37 mr-4"
                            /> -->
                            <div>
                                <h2
                                    class="text-3xl font-semibold text-gray-900"
                                >
                                    {{ product.name }}
                                </h2>
                                <p class="text-gray-600 mt-1 text-xl">
                                    Selected size: {{ product.size }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <select
                                v-model="product.size"
                                @change="onUpdateSize(product)"
                                class="bg-white border border-gray-300 text-gray-900 text-lg rounded-lg block w-38 p-2 hover:cursor-pointer"
                            >
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                            </select>
                            <div class="flex items-center gap-2 mt-4">
                                <button
                                    @click="editCallBack(product)"
                                    class="bg-blue-500 px-4.5 py-1.5 text-white rounded-md hover:bg-blue-600 transition-colors duration-300 hover:cursor-pointer"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="deleteSubmit(product)"
                                    class="bg-red-500 px-4.5 py-1.5 text-white rounded-md hover:bg-red-600 transition-colors duration-300 hover:cursor-pointer"
                                >
                                    Delete
                                </button>
                            </div>
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
                    toast.success("Size updated successfully!", {
                        autoClose: 3000,
                    });
                },
            }
        );
    } catch (error) {
        toast.error("Size updated failed!", {
            autoClose: 3000,
        });
    }
};

const createCallBack = () => {
    router.visit("/products/create");
};

const editCallBack = (product) => {
    router.visit(`/products/${product.id}/edit`);
};

const deleteSubmit = (product) => {
    router.delete(`/products/${product.id}`, {
        onSuccess: () => {
            toast.success("Product deleted successfully!", {
                autoClose: 3000,
            });
        },
        onError: () => {
            toast.error("Failed to delete product!", {
                autoClose: 3000,
            });
        },
    });
};
</script>
