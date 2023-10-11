<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    canResetPassword: {
        Boolean,
        status: String,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
                    <div class="flex items-center gap-4 h-200">

                        <div class="flex flex-col">
                            <ApplicationLogo class="w-60 h-60">
                            </ApplicationLogo>
    
                            <div class="grid justify-items-center">
                                <h2 class=" font-mono text-gray-600 font-bold text-5xl">BareluPOS</h2>
                            </div>

                        </div>


                        <div v-if="canLogin" class="">
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Ingresar al Sistema</Link>

                            <template v-else>

                                <form @submit.prevent="submit">
                                    <div>
                                        <InputLabel for="email" value="Correo" />
                                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                            required autofocus autocomplete="username" />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>

                                    <div class="mt-3">
                                        <InputLabel for="password" value="Contraseña" />
                                        <TextInput id="password" type="password" class="mt-1 block w-full"
                                            v-model="form.password" required autocomplete="current-password" />
                                        <InputError class="mt-2" :message="form.errors.password" />
                                    </div>

                                    <div class="mt-4 flex justify-between">
                                        <label class="inline-flex items-center">
                                            <Checkbox name="remember" v-model:checked="form.remember" />
                                            <span class="mx-2 text-sm text-gray-600">Recuerdame</span>
                                        </label>

                                        <Link v-if="canResetPassword" :href="route('password.request')"
                                            class="text-sm text-gray-600 underline hover:text-gray-900">
                                        Olvidaste tu contraseña?
                                        </Link>
                                    </div>

                                    <div class="mt-6">
                                        <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }"
                                            :disabled="form.processing">
                                            Ingresar
                                        </PrimaryButton>
                                    </div>
                                </form>

                            </template>
                        </div>

                    </div>
                <!-- </div>

            </div> -->
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: linear-gradient(to left bottom, #59a1f0, #6bb1f0, #82c0ef, #9cceee, #b8dbee, #aee4f7, #a3ecfd, #98f5ff, #48fcf5, #00ffd7, #00ffa6, #0fff62);
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: linear-gradient(to left bottom, #59a1f0, #6bb1f0, #82c0ef, #9cceee, #b8dbee, #aee4f7, #a3ecfd, #98f5ff, #48fcf5, #00ffd7, #00ffa6, #0fff62);
        /* background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    */
    }
}
</style>
