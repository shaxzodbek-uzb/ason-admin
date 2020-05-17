<template>
    <default-field :field="field">
        <template slot="field">
            <div class="flex" v-for="row in rows" :key="row.id">
                <div class="w-3/4 py-3 mr-1">
                    <input type="text"
                           class="w-full form-control form-input form-input-bordered"
                           :class="errorClasses"
                           placeholder="Key"
                           v-model="row.name"
                           :disabled="true"
                    />
                </div>
                <div class="w-3/4 py-3">
                    <select-control
                        class="form-control form-select mb-3 w-full"
                        :class="{ 'border-danger': hasError }"
                        :data-testid="`${field.resourceName}-select`"
                        :dusk="field.attribute"
                        v-model="row.property_value_id"
                        label="display"
                    >
                        <option :value="0">&mdash;</option>
                        <option
                            v-for="option in row.values"
                            :key="option.id"
                            :value="option.id"
                        >
                            {{ option.value }}
                        </option>
                    </select-control>
                </div>
            </div>
            <div class="flex justify-end">
                
                <progress-button
                    dusk="update-and-continue-editing-button"
                    @click.native="saveChanges"
                    :disabled="isWorking"
                    :processing="submittedViaUpdateAndContinueEditing">
                    {{ __('Update') }}
                </progress-button>
            </div>
            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>

import storage from '../storage/ProductProperty'
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resource', 'resourceName', 'resourceId', 'field'],
    
    data() {
        return {
            rows: [],
            checkbox: false,
            isWorking: false
        }
    },
    mounted() {
        storage.fetchAvailableResources(this.resourceId, null)
            .then(({data: {properties, product_properties}}) => {
                for (let i in properties){
                    const item = properties[i];
                    this.rows.push({id: item.id, name: item.name, property_value_id: 0, values: item.values});
                }
                for(let i in this.rows){
                    const item = this.rows[i];
                    
                    for (let i in product_properties){
                        const item1 =  product_properties[i];
                        if (item1.property_id == item.id){
                            item.property_value_id = item1.property_value_id;
                            break;
                        }
                    }
                }
            });
    },

    methods: {
        saveChanges(){
            this.isWorking  = true;
            const props = [];
            for (let i in this.rows){
                const item = this.rows[i];
                props.push({property_id: item.id, property_value_id: item.property_value_id, product_id: this.resourceId});
            }
            storage.savePropertyChanges(this.resourceId, props)
            .then(({data}) => {
                this.$toasted.show(
                    this.__('The :resource was updated!', {
                        resource: "Product",
                    }),
                    { type: 'success' }
                )
            })
            .then(() => {
                this.isWorking = false;
            });
        }
    }
}
</script>