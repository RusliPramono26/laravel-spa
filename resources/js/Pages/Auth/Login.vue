<template>
    <form @submit.prevent="Login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">Email</label>
                <input type="text" name="email" id="email" class="input" v-model="form.email">
                <div class="input-error" v-if="form.errors">{{ form.errors.email }}</div>
            </div>
            <div class="mt--4">
                <label for="password" class="label">Password</label>
                <input type="password" name="password" id="password" class="input" v-model="form.password">
                <div class="input-error" v-if="form.errors">{{  form.errors.password }}</div>
            </div>
            <div class="mt--4">
                <button class="btn-primary w-full">Login</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy';

const form = useForm({
    email: null,
    password: null,
})

const Login = ()=> form.post(route('login.store'))
</script>