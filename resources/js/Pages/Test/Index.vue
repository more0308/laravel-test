<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref} from "vue";

const props = defineProps({
  tests: {
    type: Object,
    default: () => ({})
  },
});

const tests = ref(props.tests);

function destroy(id) {
  axios.delete(route('test.destroy', id)).then(
      () => {
        tests.value = tests.value.filter((item) => item.id !== id);
      }
  )
}

</script>

<template>
    <Head title="Tests" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tests</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a v-if="$page.props.auth.user.role === 'admin'" href="/test/create" class="mb-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Go to Create Page
                </a>


              <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                      full name
                    </th>
                    <th scope="col" class="px-6 py-3">
                      location
                    </th>
                    <th scope="col" class="px-6 py-3">
                      date
                    </th>
                    <th scope="col" class="px-6 py-3">
                      grade
                    </th>
                      <th scope="col" class="px-6 py-3">
                          criterion
                    </th>
                    <th scope="col" class="px-6 py-3">
                      manager
                    </th>
                    <th scope="col" class="px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                      <span class="sr-only">Delete</span>
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="test in tests" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ test.full_name }}
                    </th>
                    <td class="px-6 py-4">
                      {{ test.test_location }}
                    </td>
                    <td class="px-6 py-4">
                      {{ test.test_date }}
                    </td>
                    <td class="px-6 py-4">
                      {{ test.grade }}
                    </td>
                      <td class="px-6 py-4">
                      {{ test.criterion }}
                    </td>
                    <td class="px-6 py-4">
                      {{ test.manager_name }}
                    </td>
                    <td class="px-6 py-4 text-right">
                      <a :href="route('test.edit', test.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button @click="destroy(test.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</button>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
