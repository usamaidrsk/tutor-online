<template>
    <div :class="classes" :styles="styles">
        <label v-if="label" class="input__label">{{ label }}</label>
        <input v-if="!textarea" v-model="innerValue" v-bind="attrs" />
        <textarea v-else v-model="innerValue" v-bind="attrs"></textarea>
        <span v-show="!isValid" class="input__error" role="alert">{{
            error
        }}</span>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            validator: value =>
                value === null ||
                typeof value === 'string' ||
                typeof value === 'number',
        },
        label: String,
        type: {
            type: String,
            default: 'text',
            validate: value =>
                ['text', 'tel', 'number', 'date', 'email', 'password'].includes(
                    value
                ),
        },
        error: String,
        width: { type: String, default: '100%' },
        textarea: Boolean,
        disabled: Boolean,
    },

    data: self => ({ innerValue: self.value }),

    watch: {
        innerValue(value) {
            this.$emit('input', value)
        },
    },

    computed: {
        isValid() {
            return !this.error
        },

        isRequired() {
            return 'required' in this.$attrs
        },

        isDisabled() {
            return this.disabled
        },

        classes() {
            return {
                input: true,
                [`input--is-${this.type}`]: true,
                'input--is-invalid': !this.isValid,
                'input--is-required': this.isRequired,
                'input--is-optional': !this.isRequired,
            }
        },

        styles() {
            return { width: this.width }
        },

        attrs() {
            return {
                ...this.$attrs,
                class: {
                    input__field: true,
                    input__textarea: this.textarea,
                },
                type: this.type,
                disabled: this.isDisabled,
            }
        },
    },
}
</script>

<style lang="scss">
// General
$input-background: color('white');
$input-height: 38px;
$input-padding-x: 9px;
$input-padding-y: 0;
$input-padding: $input-padding-y $input-padding-x;
$input-margin-top: 10px;
$input-margin-bottom: 15px;

// Valid/Invalid
$input-invalid-color: color('red');
$input-focus-color: color('primary');

// Borders
$input-border-width: 2px;
$input-border-color: color('gray', 100);
$input-hover-border-color: shade($input-border-color, 10%);
$input-border-radius: 4px;

// Field
$input-field-color: inherit;
$input-field-font: inherit;
$input-field-font-weight: get('light', $font-weights);
$input-field-line-height: $input-height;

$input-field-disabled-color: $input-border-color;
$input-field-disabled-background: tint($input-border-color, 75%);

// Label
$input-label-color: color('gray', 400);
$input-label-font-weight: get('medium', $font-weights);
$input-label-font-size: 14px;

// Error
$input-error-color: $input-invalid-color;
$input-error-font-size: 14px;
$input-error-font-weight: get('medium', $font-weights);

// Helper
$input-helper-color: color('gray', 600);
$input-helper-font-size: 12px;

// Placeholder
$input-placeholder-color: color('gray', 600);
$input-placeholder-font-weight: get('light', $font-weights);

// Icon
$input-icon-color: shade($input-border-color, 25%);

.input {
    @include margin($input-margin-top, false, $input-margin-bottom);

    position: relative;
    max-width: 100%;
}

// Label
.input__label {
    padding-left: $input-padding-x;
    color: $input-label-color;
    font-size: $input-label-font-size;
    font-weight: $input-label-font-weight;
    text-transform: uppercase;
    white-space: nowrap;
    pointer-events: none;
    cursor: text;

    .input__field:focus + & {
        color: $input-focus-color;
    }
    .input--is-invalid & {
        color: $input-invalid-color !important;
    }

    // `(Optional)` flag
    // .input--is-optional &::after {
    //     content: '(Opcional)';
    //     margin-left: 5px;
    //     color: color('gray', 800);
    // }
}

.input__field {
    &:not(textarea) {
        height: $input-height;
    }

    width: 100%;
    background: $input-background;
    padding: $input-padding;

    // Make border with box-shadow for smoother border radius
    box-shadow: 0 0 0 $input-border-width $input-border-color;
    border-radius: $input-border-radius;
    color: $input-field-color;
    font: $input-field-font;
    font-weight: $input-field-font-weight;
    line-height: $input-field-line-height;
    transition: border-color 0.1s;
    cursor: text;

    .input--is-invalid & {
        box-shadow: 0 0 0 $input-border-width $input-invalid-color !important;
    }
    &:hover {
        box-shadow: 0 0 0 $input-border-width $input-hover-border-color;
    }
    &:focus {
        box-shadow: 0 0 0 $input-border-width $input-focus-color;
    }
    &:disabled {
        color: $input-field-disabled-color;
        background: $input-field-disabled-background;
        cursor: default;
    }

    &::placeholder {
        color: $input-placeholder-color;
        font-weight: $input-placeholder-font-weight;
    }
}

.input__textarea {
    resize: vertical;
    line-height: 1.5;
    padding-top: $input-padding-x;
    padding-bottom: $input-padding-x;
}

.input__error {
    @include position(absolute, null, null, 0, $input-padding-x - 2px);
    @include ellipsis;

    transform: translateY(50%);
    max-width: 80%;
    background: $input-background;
    padding: 0 2px;
    color: $input-error-color;
    font-size: $input-error-font-size;
    font-weight: $input-error-font-weight;
    pointer-events: none;
}
</style>
