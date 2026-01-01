<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Your Name</label>
                <input type="text" name="name" id="name" class="input" v-model="form.name">
                <div class="input-error" v-if="form.errors">{{ form.errors.name }}</div>
            </div>
            <div class="mt-4">
                <label for="email" class="label">Email</label>
                <input type="text" name="email" id="email" class="input" v-model="form.email">
                <div class="input-error" v-if="form.errors">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input type="password" name="password" id="password" class="input" v-model="form.password">
                <div class="input-error" v-if="form.errors">{{  form.errors.password }}</div>
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="label">Password Confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="input" v-model="form.password_confirmation">
                <div class="input-error" v-if="form.errors">{{  form.errors.password_confirmation }}</div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full">Register</button>
                <div class="mt-2 text-center">
                    <Link :href="route('login')">Already Have a Account? Click Here</Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { route } from 'ziggy';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null
})

const register = ()=> form.post(route('user-account.store'))
</script>