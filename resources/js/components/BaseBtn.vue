<template>
    <component
        class="btn"
        :class="[{[`btn-${size}`]: size}, `btn-${variant}`]"
        :href="href"
        :title="title"
        :disabled="disabled"
        :is="component"
    >
        <span v-if="hasIcons" :class="iconClasses"></span>

        <span v-if="hasText">{{ text }}</span>
    </component>
</template>

<script>
    export default {
        name: "BaseBtn",

        props: {
            size: [String, Boolean],
            variant: {
                type: String,
                default: 'primary'
            },
            tag: String,
            href: String,
            iconClasses: {
                type: String,
                default: ''
            },
            title: {
                type: String,
                default: ''
            },
            text: {
                type: String,
                default: ''
            },
            disabled: {
                type: Boolean,
                default: false
            }
        },

        computed: {
            hasIcons() {
                return this.iconClasses.length > 0;
            },

            hasText() {
                return this.text.length > 0;
            },

            component() {
                return this.tag || 'button';
            }
        }
    }
</script>

<style scoped>
</style>
