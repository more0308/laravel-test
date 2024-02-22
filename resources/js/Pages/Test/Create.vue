<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';

const props = defineProps({
  test: {
    type: Object,
    default: {
      full_name: '',
      test_location: '',
      test_date: '',
      grade: '',
      manager_id: ''
    }
  },
    managers: {
        type: Object,
    },
});

const form = useForm(props.test);

const submit = () => {
  if (props.test.id) {
    form.patch(route('test.update', props.test.id));
  } else {
    form.post(route('test.store'));
  }
};

</script>

<template>
    <Head title="Tests" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tests</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                            <form @submit.prevent="submit">
                                <div v-if="$page.props.auth.user.role === 'admin'">
                                    <label for="full_name" class="block text-sm font-medium leading-6 text-gray-900">Full name</label>
                                    <div class="mt-2">
                                        <input v-model="form.full_name" id="full_name" name="full_name" type="text" autocomplete="full_name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div v-if="$page.props.auth.user.role === 'admin'">
                                    <label for="test_location" class="block text-sm font-medium leading-6 text-gray-900">Text location</label>
                                    <div class="mt-2">
                                        <input v-model="form.test_location" id="test_location" name="test_location" type="text" autocomplete="test_location" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div v-if="$page.props.auth.user.role === 'admin'">
                                    <label for="test_date" class="block text-sm font-medium leading-6 text-gray-900">Text date</label>
                                    <div class="mt-2">
                                        <input v-model="form.test_date" id="test_date" name="test_date" type="datetime-local" autocomplete="test_date" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="grade" class="block text-sm font-medium leading-6 text-gray-900">Grade</label>
                                    <div class="mt-2">
                                        <input v-model="form.grade" id="grade" name="grade" type="text" autocomplete="grade" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div v-if="$page.props.auth.user.role === 'admin'">
                                    <label for="manager_id" class="block text-sm font-medium leading-6 text-gray-900">Manager</label>
                                    <div class="mt-2">
                                        <select v-model="form.manager_id" id="manager_id" name="manager_id" autocomplete="manager_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option v-for="manager in managers" :key="manager.id" :value="manager.id">{{ manager.name }} - {{ manager.email }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
