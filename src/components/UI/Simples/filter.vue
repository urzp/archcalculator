<template>
    <div class="hover_effect" ref="panel">
        <div class="wrap_filter" >
            <div class="buttons">
                <UpButton @click="sortUp()" :width="'20px'" :heigth="'25px'"/>
                <DownButton @click="sortDown()" :width="'20px'" :heigth="'25px'"/>
            </div>
            <div class="v_line"></div>
            <img src="@/assets/icons/filter/main.svg" alt="">
            <div class="input">
                <InputText :value="filterWord" @submit_event="value=>filterWord=value" @input_event="value=>filter(value)" :width="'300px'"/>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name:'FilterData',
    mounted(){
        if(this.right) this.ajastPanel()
    },
    data(){
        return{
            outList:[],
            sortVector: '',
            filterWord:'',
        }
    },
    props:{
        sortName: String,
        sortype: {
            type:String,
            default: 'string'
        },
        list:{
            type:Array,
            default:[],
        },
        right:{
            type:Boolean,
            default:false,
        }
    },
    emits:['updated'],
    methods:{
        sortUp(){
            this.sortVector = 'up'
            this.outList = JSON.parse( JSON.stringify(this.list) )
            this.outList.sort(this.compare)
            this.$emit('updated', this.outList)
        },
        sortDown(){
            this.sortVector = 'down'
            this.outList = JSON.parse( JSON.stringify(this.list) )
            this.outList.sort(this.compare)
            this.$emit('updated', this.outList)
        },
        compare(a, b){
            a = a[this.sortName]
            b = b[this.sortName]
            if(this.sortype=='number'){
                a = Number(a)
                b = Number(b)
            }
            if(this.sortype=='date'){
                if(a=='-') a=0; 
                if(b=='-') b=0;
                a = new Date(a)
                b = new Date(b)
            }
            let result
            if (a > b) result = 1;
            if (a == b) result = 0;
            if (a < b) result = -1;
            if(this.sortVector=='down') result=result*(-1)
            return result
        },
        filter(value){
            this.outList = JSON.parse( JSON.stringify(this.list) )
            this.outList = this.outList.filter(item=>item[this.sortName].includes(value)) 
            this.$emit('updated', this.outList)
        },
        ajastPanel(){
            let element = this.$refs.panel
            let w = element.offsetWidth
            let w_p = element.parentElement.offsetWidth
            let x=w-w_p
            element.style.transform = `translate(-${x}px,-70px)`
        }
    }

}
</script>

<style scoped>
    .hover_effect{
        position: absolute;
        transform: translateY(-70px);
        padding-bottom: 5px;
        visibility: hidden;
    }

    .hover_effect:hover{
        visibility: visible;
    }

    .wrap_filter{
        width: 434px;
        padding: 4px;
        display: flex;
        column-gap: 5px;
        border-radius: 3px;
        border: 1px solid #929292;
    }

    .buttons{
        display: flex;
        column-gap: 5px;
    }
    .v_line{
        border-right: 1px solid #929292;
    }
    img{
        margin-right: 15px;
    }
</style>