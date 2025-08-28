<template>
    <div class="wrap">
        <div class="name_tariff">{{ text.ActiveTariff }}: Prmeum</div>
        <div class="price">{{ price }} € {{ price_period }}</div>
        <div class="time_end">{{ text.EndOfSubscription }}: {{ subscription_period_end }}</div>
        <div class="status">{{ text.statusSubscription }}: {{ status_subscription }}</div>
        <Button :width="'100px'" @click="deleteSubscription">{{ text.Unsubscribe }}</Button>
    </div>
</template>

<script>
import { text } from '@/servis/text'
import { apiData } from '@/servis/apiData.js'
import { user, global } from '@/servis/globalValues'
export default{
    name: 'ActiveTarifPlane',
    data(){
        return{
            text:{
                ActiveTariff: text.activeTarifPlane.ActiveTariff,
                EndOfSubscription: text.activeTarifPlane.EndOfSubscription,
                Unsubscribe: text.activeTarifPlane.Unsubscribe,
                statusSubscription: text.activeTarifPlane.statusSubscription,
            }
        }
    },
    props:{
        tariffs: Array
    },
    computed:{
        subscription_period_end(){
            let result = ''
            if(!!user&&!!user.subscription_period_end) {
                result = user.subscription_period_end + ' UTC'
                result = new Date(result)
                result = new Date(result.setHours(result.getHours()-2))
                result = result.toLocaleString()
                result = result.replace(',', '')
                result = result.substring(0, result.length - 3);
            }
            return result
        },
        price(){
            let result = ''
            let  tariff
            if(!!this.tariffs&&!!this.tariffs[1]) tariff = this.tariffs[1]
            if(!!tariff&&!!tariff.price&&!!tariff.price.value) result = tariff.price.value
            return result
        },
        price_period(){
            let result = ''
            let  tariff
            if(!!this.tariffs&&!!this.tariffs[1]) tariff = this.tariffs[1]
            if(!!tariff&&!!tariff.price_period) result = tariff.price_period
            return result
        },
        status_subscription(){
            let result = ''
            if(!!user&&!!user.stripe_status){ result = user.stripe_status }
            return result
        }
    },
    methods:{
        deleteSubscription(){
            //cus_StcOMsThVMxrt6
            //sub_1RxpAGL724uNY9UupHFHDmJx
            //2025-08-26 15:00:59
            let subscriptionId = user.stripe_subscription_id
            apiData({typeData:'deleteSubscription', subscriptionId})
            global.isTariffActive = false
        }
    }
}
</script>

<style scoped>
.wrap{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    height: calc(70vh - 150px);
}
.name_tariff{
    font-size: 24px;
}
.price{
    margin-top: 20px;
}
.status{
    margin-bottom: 20px;
}
</style>
