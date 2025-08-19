<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>

    <div class="it-stepper" x-data="{

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
        <div>

            <template x-if="decrementDisabled || disabled">
                <button
                    type="button"
                    class="it-stepper-btn-decrement"
                    disabled
                    x-on:click="decrease()"
                > - </button>
            </template>
            <template x-if="!decrementDisabled && !disabled">
                <button
                    type="button"
                    class="it-stepper-btn-decrement"
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
                    'fi-input',
                    'it-stepper-input',
                    'it-stepper-input-error' => $errors->has($getStatePath()),
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
                    class="it-stepper-btn-increment"
                    x-on:click="increase()"
                    disabled
                > + </button>

            </template>

            <template x-if="!incrementDisabled && !disabled">
                <button
                    type="button"
                    class="it-stepper-btn-increment"
                    x-on:click="increase()"
                > + </button>

            </template>
            
        </div>

        <template x-if="inputError">
            <div class="text-danger-400" x-html="inputError"></div>
        </template>
        
    </div>
    <style>
        .it-stepper-input::-webkit-outer-spin-button,
        .it-stepper-input::-webkit-inner-spin-button {

            -webkit-appearance: none;

        }
        .it-stepper-input {
            -moz-appearance: textfield;
        }
    </style>

</x-dynamic-component>
