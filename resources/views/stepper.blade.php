<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>

    <div x-data="{

        state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},

        disabled: {{ $isDisabled()?$isDisabled():'false' }},

        incrementDisabled: false,

        decrementDisabled: false,

        inputError:null,

        init: function(){

            this.checkDisabled()
        },

        increase: function(){

            this.$refs.stepper.stepUp()
            this.state = Number(this.$refs.stepper.value)
            this.validateData()
            this.checkDisabled()
        },

        decrease: function(){

            this.$refs.stepper.stepDown()
            this.state = Number(this.$refs.stepper.value)
            this.validateData()
            this.checkDisabled()

        },

        checkDisabled: function(){

            let value = this.$refs.stepper.value ? Number(this.$refs.stepper.value) : (this.state ? this.state : null)
            let max = this.$refs.stepper.max ? Number(this.$refs.stepper.max) : null
            let min = this.$refs.stepper.min ? Number(this.$refs.stepper.min) : null

            if(max != null && value >= max){
                this.incrementDisabled = true
            }else{
                this.incrementDisabled = false
            }

            if(min != null && value <= min){
                this.decrementDisabled = true
            }else{
                this.decrementDisabled = false
            }

        },

        validateData: function(){

            this.inputError = null

            let value = this.$refs.stepper.value ? Number(this.$refs.stepper.value) : null

            if(value == null){
                return 
            }

            if(this.$refs.stepper.min && value < Number(this.$refs.stepper.min)){
                this.inputError = 'The input value must greater than or equal to <span class=\'font-bold\'>' + this.$refs.stepper.min + '</span>.'
                return
            }

            if(this.$refs.stepper.max && value > Number(this.$refs.stepper.max)){
                this.inputError = 'The input value must less than or equal to <span class=\'font-bold\'>' + this.$refs.stepper.max + '</span>.'
                return
            }
            
            return true

        },

        blurInput: function(){
            this.state = this.$refs.stepper.value ? Number(this.$refs.stepper.value) : null
            this.validateData()
            this.checkDisabled()
        }

    }">
        <!-- Interact with the `state` property in Alpine.js -->
        <div class="flex items-center">

            <template x-if="decrementDisabled || disabled">
                <button
                    type="button"
                    class="w-10 h-10 rounded-l bg-gray-300 text-white text-lg font-bold"
                > - </button>
            </template>
            <template x-if="!decrementDisabled && !disabled">
                <button
                    type="button"
                    class="w-10 h-10 rounded-l bg-primary-500 text-white text-lg font-bold"
                    x-on:click="decrease()"
                > - </button>
            </template>
            
            <input
                x-ref="stepper"
                type="number"
                id="{{ $getId() }}"
                x-model = "state"
                {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!}
                {!! ($interval = $getStep()) ? "step=\"{$interval}\"" : null !!}
                {!! $isDisabled()||$isManualInputDisabled() ? 'disabled' : null !!}
                {{ $getExtraInputAttributeBag()->class([
                    'block w-full transition duration-75 shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70 filament-stepper',
                    'dark:bg-gray-700 dark:text-white dark:focus:border-primary-600' => config('forms.dark_mode'),
                    'border-gray-300' => ! $errors->has($getStatePath()),
                    'dark:border-gray-600' => (! $errors->has($getStatePath())) && config('forms.dark_mode'),
                    'border-danger-600 ring-danger-600' => $errors->has($getStatePath()),
                ]) }}
                @if (! $isConcealed())
                    {!! filled($value = $getMaxValue()) ? "max=\"{$value}\"" : null !!}
                    {!! filled($value = $getMinValue()) ? "min=\"{$value}\"" : null !!}
                    {!! $isRequired() ? 'required' : null !!}
                @endif
                x-on:blur="blurInput()"
            />
            
            <template x-if="incrementDisabled || disabled">
                <button
                    type="button"
                    class="w-10 h-10 rounded-r bg-gray-300 text-white text-lg font-bold"
                    disabled
                > + </button>

            </template>

            <template x-if="!incrementDisabled && !disabled">
                <button
                    type="button"
                    class="w-10 h-10 rounded-r bg-primary-500 text-white text-lg font-bold"
                    x-on:click="increase()"
                > + </button>

            </template>
            
        </div>

        <template x-if="inputError">
            <div class="text-danger-400" x-html="inputError"></div>
        </template>
        
    </div>
    <style>
        .filament-stepper::-webkit-outer-spin-button,
        .filament-stepper::-webkit-inner-spin-button {

            -webkit-appearance: none;

        }
        .filament-stepper {
            -moz-appearance: textfield;
        }
    </style>

</x-dynamic-component>
