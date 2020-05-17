export default {
    fetchAvailableResources(productId, params) {
        return Nova.request().get(
            `/nova-api/product-properties/${productId}/list`,
            params
        )
    },
    savePropertyChanges(productId, params) {
        return Nova.request().post(
            `/nova-api/product-properties/${productId}/save`,
            params
        )
    },
    determineIfSoftDeletes(resourceName) {
        return Nova.request().get(`/nova-api/${resourceName}/soft-deletes`)
    },
}
