<?php
/* @var \Vehica\Widgets\General\RegisterV2GeneralWidget $vehicaCurrentWidget */
global $vehicaCurrentWidget;
?>
<div class="vehica-register-v2 vehica-register vehica-app">
    <vehica-register
            vehica-nonce="<?php echo esc_attr(wp_create_nonce('vehica_register')); ?>"
            request-url="<?php echo esc_url(admin_url('admin-post.php?action=vehica_register')); ?>"
            panel-page="<?php echo esc_url(\Vehica\Widgets\General\PanelGeneralWidget::getCarListPageUrl()); ?>"
            :accept-policy="<?php echo esc_attr($vehicaCurrentWidget->hasPolicyLabel() ? 'true' : 'false'); ?>"
            :is-admin="<?php echo esc_attr(is_user_logged_in() && current_user_can('manage_options') ? 'true' : 'false'); ?>"
            :phone-required="<?php echo esc_attr($vehicaCurrentWidget->isPhoneNumberFieldRequired() ? 'true' : 'false'); ?>"
        <?php if (vehicaApp('recaptcha')) : ?>
            :re-captcha="true"
            re-captcha-key="<?php echo esc_attr(vehicaApp('settings_config')->getRecaptchaSite()); ?>"
        <?php endif; ?>
    >
        <div slot-scope="registerForm">
            <form @submit.prevent="registerForm.onRegister">

                <template v-if="registerForm.message && registerForm.message !== ''">
                    <div>
                        {{ registerForm.message }}
                    </div>
                </template>

                <template>
                    <div v-if="registerForm.showErrors">
                        <div v-if="!registerForm.errors.termsAccept.sameAs" class="vehica-register-login-notice">
                            <?php echo esc_html(vehicaApp('must_accept_privacy_policy_string')); ?>
                        </div>
                    </div>
                </template>

                <div class="vehica-fields">
                    <div
                            class="vehica-field"
                            :class="{'vehica-field--validation-required': registerForm.showNameError}"
                    >
                        <input
                                id="<?php echo esc_attr(\Vehica\Managers\RegisterManager::NAME); ?>"
                                name="<?php echo esc_attr(\Vehica\Managers\RegisterManager::NAME); ?>"
                                @input="registerForm.setName($event.target.value)"
                                :value="registerForm.name"
                                type="text"
                                placeholder="<?php echo esc_attr(vehicaApp('username_string')); ?>*"
                                required
                        >

                        <template>
                            <div
                                    v-if="registerForm.showErrors"
                                    class="vehica-field--validation-required__tip"
                            >
                                <div
                                        v-if="!registerForm.errors.name.required"
                                        class="vehica-field--validation-required__tip__text"
                                >
                                    <?php echo esc_html(vehicaApp('field_is_required_string')); ?>
                                </div>

                                <div
                                        v-if="!registerForm.errors.name.minLength"
                                        class="vehica-field--validation-required__tip__text"
                                >
                                    <?php echo esc_html(vehicaApp('login_min_letters_string')); ?>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div
                            class="vehica-field"
                            :class="{'vehica-field--validation-required': registerForm.showEmailError}"
                    >
                        <input
                                id="<?php echo esc_attr(\Vehica\Managers\RegisterManager::EMAIL); ?>"
                                name="<?php echo esc_attr(\Vehica\Managers\RegisterManager::EMAIL); ?>"
                                @input="registerForm.setMail($event.target.value)"
                                :value="registerForm.email"
                                type="text"
                                placeholder="<?php echo esc_attr(vehicaApp('email_string')); ?>*"
                                required
                        >

                        <template>
                            <div
                                    v-if="registerForm.showErrors"
                                    class="vehica-field--validation-required__tip"
                            >
                                <div
                                        v-if="!registerForm.errors.email.required"
                                        class="vehica-field--validation-required__tip__text"
                                >
                                    <?php echo esc_html(vehicaApp('field_is_required_string')); ?>
                                </div>

                                <div
                                        v-if="!registerForm.errors.email.email"
                                        class="vehica-field--validation-required__tip__text"
                                >
                                    <?php echo esc_html(vehicaApp('email_invalid_format_string')); ?>
                                </div>
                            </div>
                        </template>
                    </div>

                    <?php if ($vehicaCurrentWidget->showPhoneNumberField()) : ?>
                        <div
                                class="vehica-field"
                                :class="{'vehica-field--validation-required': registerForm.showPhoneError}"
                        >
                            <input
                                    id="<?php echo esc_attr(\Vehica\Managers\RegisterManager::PHONE); ?>"
                                    name="<?php echo esc_attr(\Vehica\Managers\RegisterManager::PHONE); ?>"
                                    @input="registerForm.setPhone($event.target.value)"
                                    :value="registerForm.phone"
                                    type="text"
                                <?php if ($vehicaCurrentWidget->isPhoneNumberFieldRequired()) : ?>
                                    placeholder="<?php echo esc_attr(vehicaApp('phone_string')); ?>*"
                                    required
                                <?php else : ?>
                                    placeholder="<?php echo esc_attr(vehicaApp('phone_string')); ?>"
                                <?php endif; ?>
                            >

                            <template>
                                <div
                                        v-if="registerForm.showErrors"
                                        class="vehica-field--validation-required__tip"
                                >
                                    <div
                                            v-if="!registerForm.errors.phone.isPhone"
                                            class="vehica-field--validation-required__tip__text"
                                    >
                                        <?php echo esc_attr(vehicaApp('only_numbers_string')); ?>
                                    </div>

                                    <?php if ($vehicaCurrentWidget->isPhoneNumberFieldRequired()) : ?>
                                        <div
                                                v-if="!registerForm.errors.phone.required"
                                                class="vehica-field--validation-required__tip__text"
                                        >
                                            <?php echo esc_html(vehicaApp('field_is_required_string')); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </template>
                        </div>
                    <?php endif; ?>

                    <div
                            class="vehica-field"
                            :class="{'vehica-field--validation-required': registerForm.showPasswordError}"
                    >
                        <input
                                id="vehica-register-<?php echo esc_attr(\Vehica\Managers\RegisterManager::PASSWORD); ?>"
                                name="<?php echo esc_attr(\Vehica\Managers\RegisterManager::PASSWORD); ?>"
                                @input="registerForm.setPassword($event.target.value)"
                                :value="registerForm.password"
                                type="password"
                                placeholder="<?php echo esc_attr(vehicaApp('password_string')); ?>*"
                                required
                        >

                        <template>
                            <div
                                    v-if="registerForm.showErrors"
                                    class="vehica-field--validation-required__tip"
                            >
                                <div
                                        v-if="!registerForm.errors.password.required"
                                        class="vehica-field--validation-required__tip__text"
                                >
                                    <?php echo esc_html(vehicaApp('field_is_required_string')); ?>
                                </div>

                                <div
                                        v-if="!registerForm.errors.password.minLength"
                                        class="vehica-field--validation-required__tip__text"
                                >
                                    <?php echo esc_html(vehicaApp('password_min_letters_string')); ?>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="vehica-register__select-user-role">
                    <div class="vehica-register__user-role">
                        <div class="vehica-radio">
                            <input
                                    id="role_private"
                                    type="radio"
                                    value="private"
                                    name="<?php echo esc_attr(\Vehica\Managers\RegisterManager::ROLE); ?>"
                                    @change.prevent="registerForm.setRole('private')"
                                    :checked="registerForm.role === 'private'"
                            >

                            <label for="role_private">
                                <?php echo esc_html(vehicaApp('private_role_string')) ?>
                            </label>
                        </div>
                    </div>

                    <div class="vehica-register__user-role">
                        <div class="vehica-radio">
                            <input
                                    id="role_business"
                                    type="radio"
                                    value="business"
                                    name="<?php echo esc_attr(\Vehica\Managers\RegisterManager::ROLE); ?>"
                                    @change.prevent="registerForm.setRole('business')"
                                    :checked="registerForm.role === 'business'"
                            >

                            <label for="role_business">
                                <?php echo esc_html(vehicaApp('business_role_string')) ?>
                            </label>
                        </div>
                    </div>
                </div>

                <?php if ($vehicaCurrentWidget->hasPolicyLabel()) : ?>
                    <div class="vehica-register__terms">
                        <div class="vehica-checkbox">
                            <input
                                    :checked="registerForm.termsAccept"
                                    @change="registerForm.setTermsAccept"
                                    type="checkbox"
                                    id="checkbox_terms"
                            >

                            <label for="checkbox_terms">
                                <?php echo wp_kses_post($vehicaCurrentWidget->getPolicyLabel()); ?>
                            </label>
                        </div>
                    </div>
                <?php endif; ?>

                <button
                        class="vehica-button vehica-button--register vehica-button--with-progress-animation"
                        :class="{'vehica-button--with-progress-animation--active': registerForm.inProgress}"
                        :disabled="registerForm.inProgress"
                >
                    <template>
                        <svg
                                v-if="registerForm.inProgress"
                                width="120"
                                height="30"
                                viewBox="0 0 120 30"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="#fff"
                        >
                            <circle cx="15" cy="15" r="15">
                                <animate attributeName="r" from="15" to="15"
                                         begin="0s" dur="0.8s"
                                         values="15;9;15" calcMode="linear"
                                         repeatCount="indefinite"/>
                                <animate attributeName="fill-opacity" from="1" to="1"
                                         begin="0s" dur="0.8s"
                                         values="1;.5;1" calcMode="linear"
                                         repeatCount="indefinite"/>
                            </circle>
                            <circle cx="60" cy="15" r="9" fill-opacity="0.3">
                                <animate attributeName="r" from="9" to="9"
                                         begin="0s" dur="0.8s"
                                         values="9;15;9" calcMode="linear"
                                         repeatCount="indefinite"/>
                                <animate attributeName="fill-opacity" from="0.5" to="0.5"
                                         begin="0s" dur="0.8s"
                                         values=".5;1;.5" calcMode="linear"
                                         repeatCount="indefinite"/>
                            </circle>
                            <circle cx="105" cy="15" r="15">
                                <animate attributeName="r" from="15" to="15"
                                         begin="0s" dur="0.8s"
                                         values="15;9;15" calcMode="linear"
                                         repeatCount="indefinite"/>
                                <animate attributeName="fill-opacity" from="1" to="1"
                                         begin="0s" dur="0.8s"
                                         values="1;.5;1" calcMode="linear"
                                         repeatCount="indefinite"/>
                            </circle>
                        </svg>
                    </template>

                    <span><?php echo esc_html(vehicaApp('register_string')); ?></span>
                </button>
            </form>

            <div class="vehica-register__social-text">
                Or continue with
            </div>

            <div class="vehica-account-socials">
                <a href="#" class="vehica-account-socials__icon">
                    <i class="fab fa-facebook"></i>
                </a>

                <a href="#" class="vehica-account-socials__icon">
                    <i class="fab fa-google"></i>
                </a>

                <a href="#" class="vehica-account-socials__icon">
                    <i class="fab fa-twitter"></i>
                </a>

                <?php if (vehicaApp('settings_config')->isGoogleAuthEnabled()) : ?>
                    <div>
                        <a href="<?php echo esc_url(admin_url('admin-post.php?action=vehica/socialAuth/google')); ?>">
                            Google Auth
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (vehicaApp('settings_config')->isFacebookAuthEnabled()) : ?>
                    <div>
                        <a href="<?php echo esc_url(admin_url('admin-post.php?action=vehica/socialAuth/facebook')); ?>">
                            Facebook Auth
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </vehica-register>
</div>