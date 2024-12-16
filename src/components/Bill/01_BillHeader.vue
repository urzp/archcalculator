<template>
    <div class="bill_header">
        <div class="top_row">
            <div class="name_user light-text">{{ name_user }}</div>
            <div v-if="useAvatar" class="logo_bill">
                <div><img :src="url_avatar" alt=""></div>
            </div>
        </div>
        <div class="custemer">
            <div class="company bold-text">{{ customer.company }}</div>
            <div class="name bold-text">{{ customer.name }}</div>
            <div class="adresse_1 bold-text">{{ customer.adresse_1 }}</div>
            <div class="adresse_2 bold-text">{{ customer.adresse_2 }}</div>
        </div>
        <div class="main_data_bill">
            <div class="title_project_bill bold-text">{{ project.title }}</div>
            <div class="discription light-text">{{ project.dicription }}</div> 
            <div class="payment_date light-text">{{ `Leistungszeitraum vom ${payment_date.vom} bis ${payment_date.bis}` }}</div>
            <div class="item_title_value">
                <div class="invoice_number title bold-text">Rechnung Nr.</div>
                <div class="invoice_number value bold-text">{{ invoice_number }}</div>
            </div>
            <div class="item_title_value">
                <div class="datum title bold-text">Datum</div>
                <div class="datum value bold-text">{{ `${datum.getDay()}.${datum.getMonth() + 1}.${datum.getFullYear()}` }}</div>
            </div>
            <div class="number_bill">
                <div class="title bold-text">{{ number_bill }}</div>
            </div>
            <div class="greeting_phrase light-text">{{ greeting_phrase }}</div>
        </div>
    </div>   
</template>


<script>
import { global, user } from '@/servis/globalValues.js'
export default{
    name: 'BillHeader',
    data(){
        return {
            name_user: 'Viktor Filimonow Architekt – Adressstreet - 00000 City',
            customer:{
                company: 'Customer Company',
                name: 'Customer Name',
                adresse_1: 'Street',
                adresse_2: '80339 München',
            },
            project:{
                title: 'Project X',
                dicription: 'Wohnprojekt in [Ort] mit [Anzahl] Wohneinheiten. Moderne Architektur, Fokus auf Nachhaltigkeit und Funktionalität. Attraktive Lage mit guter Anbindung.',
            },
            payment_date:{
                vom: '18.04.23',
                bis: '26.07.24',
            },
            invoice_number: 'RE0011',
            datum: new Date(),
            number_bill:'8. Abschlagsrechnung',
            greeting_phrase: 'Sehr geehrte Damen und Herren, für die Leistungen am o. g. Projekt darf ich als Abschlag wie folgt in Rechnung stellen:',
        }
    },
    computed:{
        useAvatar(){
            let result = false
            if(!!global.login) {
                result = !!user.avatar
            }
            return result
        },
        url_avatar(){
            let url = `${global.base_url}/users/user_${user.id}/avatar/${user.avatar}`
            return url
        },
    }
}

</script>

<style scoped>
    .bill_header{
        font-size: 18px;
    }

    .top_row{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .logo_bill img{
        width: 63px;
        height: 63px;
    }

    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .main_data_bill{
        margin-top: 50px;
    }

    .main_data_bill .discription{
        width: 60%;
    }

    .payment_date{
        margin-top: -10px;
        text-align: right;
    }

    .item_title_value{
        display: flex;
        justify-content: space-between;
    }

    .number_bill{
        margin-top: 30px;
        border-bottom: 1px solid #999999 ;
    }

    .greeting_phrase{
        margin-top: 30px;
        margin-bottom: 30px;
        margin-left: 100px;
    }

</style>