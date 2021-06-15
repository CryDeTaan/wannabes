<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo class="flex justify-center"/>
            <h2 class="mt-4 text-center text-3xl font-extrabold text-gray-900 dark:text-dark-400">
                Create your account
            </h2>
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="name" value="Username" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                <div class="mt-2 p-1 border dark:border-dark-600 rounded-md shadow-md">
                    <p class="text-sm text-neutral-600 dark:text-dark-400">
                        Why share your email address online when you can hide it?
                    </p>
                    <div class="relative flex items-center">
                        <p class="text-sm text-neutral-600 dark:text-dark-400">
                            Hide it using a Phantom's Mask -
                            <a target="_blank" href="https://mailphantom.io" class="underline text-sm text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-500">
                                mailphantom.io
                            </a>
                        </p>
                        <ExternalLinkIcon class="ml-1 h-3 w-3 text-gray-400 dark:text-dark-500" aria-hidden="true"  />
                        <div class="absolute bottom-0 right-0">
                            <p class="-mb-1.5 text-sm text-neutral-400 dark:text-dark-500">Ad</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-500">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-500">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link :href="route('login')" class="underline text-sm text-gray-600 dark:text-dark-300 hover:text-gray-900 dark:hover:text-dark-500">
                    Already registered?
                </inertia-link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import { ExternalLinkIcon } from '@heroicons/vue/outline'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            ExternalLinkIcon
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
