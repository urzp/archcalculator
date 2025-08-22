<template>
    <div class="wrap">
        <div class="name_tariff">{{ text.ActiveTariff }}: Prmeum</div>
        <div class="price">25 € Pro Monat</div>
        <div class="time_end">{{ text.EndOfSubscription }}: 10/08/2025 16:00</div>
        <Button :width="'100px'">{{ text.Unsubscribe }}</Button>
    </div>
</template>

<script>
import { text } from '@/servis/text'
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'ActiveTarifPlane',
    data(){
        return{
            text:{
                ActiveTariff: text.activeTarifPlane.ActiveTariff,
                EndOfSubscription: text.activeTarifPlane.EndOfSubscription,
                Unsubscribe: text.activeTarifPlane.Unsubscribe,
            }
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
.time_end{
    margin-bottom: 20px;
}
</style>
