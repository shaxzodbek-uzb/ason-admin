Nova.booting((Vue, router, store) => {
    Vue.component('index-product-property', require('./components/IndexField'))
    Vue.component('detail-product-property', require('./components/DetailField'))
    Vue.component('form-product-property', require('./components/FormField'))
})
