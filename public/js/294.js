"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[294],{1050:(e,t,o)=>{o.d(t,{Z:()=>l});var n=o(4015),r=o.n(n),s=o(3645),a=o.n(s)()(r());a.push([e.id,".guest[data-v-6f665f2c]{background-image:url(/images/bottom_bg.png);background-position:bottom;background-repeat:no-repeat;background-size:100% 58%}@media (max-width:480px){.guest[data-v-6f665f2c]{background-image:none}}","",{version:3,sources:["webpack://./resources/js/Layouts/Guest.vue"],names:[],mappings:"AA2BA,wBAII,2CAA8C,CAF9C,0BAA2B,CAD3B,2BAA4B,CAE5B,wBAEJ,CAQA,yBAEI,wBACI,qBACJ,CAEJ",sourcesContent:['<template>\n    <div class="flex h-screen guest">\n        <div class="w-full flex-col shadow-md flex items-center">\n            <div class="flex justify-center items-center">\n                <ApplicationLogo class="mb-10 mt-10 mr-5 w-20 h-20 fill-current text-gray-500"/>\n                <span class="font-sans text-4xl subpixel-antialiased tracking-wider">SHOOT IT</span>\n            </div>\n\n            <slot />\n\n        </div>\n    </div>\n</template>\n\n<script>\nimport ApplicationLogo from \'@/Components/ApplicationLogo.vue\'\nimport {Link} from \'@inertiajs/inertia-vue3\';\nexport default {\n    components: {\n        ApplicationLogo,\n        Link,\n    }\n}\n<\/script>\n\n<style scoped>\n\n.guest {\n    background-repeat: no-repeat;\n    background-position: bottom;\n    background-size: 100% 58%;\n    background-image: url(\'/images/bottom_bg.png\');\n}\n\n/*Hide in Other Small Devices */\n\n\n\n\n/* Portrait phones and smaller */\n@media (max-width: 480px) {\n\n    .guest {\n        background-image: none;\n    }\n\n}\n\n</style>\n'],sourceRoot:""}]);const l=a},2278:(e,t,o)=>{o.d(t,{Z:()=>a});var n=o(1916),r=["type"];const s={props:{type:{type:String,default:"submit"}}};const a=(0,o(3744).Z)(s,[["render",function(e,t,o,s,a,l){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{type:o.type,class:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"},[(0,n.renderSlot)(e.$slots,"default")],8,r)}]])},7461:(e,t,o)=>{o.d(t,{Z:()=>a});var n=o(1916),r=["value"];const s={props:["modelValue"],emits:["update:modelValue"],methods:{focus:function(){this.$refs.input.focus()}}};const a=(0,o(3744).Z)(s,[["render",function(e,t,o,s,a,l){return(0,n.openBlock)(),(0,n.createElementBlock)("input",{class:"border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm",value:o.modelValue,onInput:t[0]||(t[0]=function(t){return e.$emit("update:modelValue",t.target.value)}),ref:"input"},null,40,r)}]])},4503:(e,t,o)=>{o.d(t,{Z:()=>i});var n=o(1916),r={class:"block font-medium text-sm text-gray-700"},s={key:0},a={key:1};const l={props:["value"]};const i=(0,o(3744).Z)(l,[["render",function(e,t,o,l,i,c){return(0,n.openBlock)(),(0,n.createElementBlock)("label",r,[o.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",s,(0,n.toDisplayString)(o.value),1)):((0,n.openBlock)(),(0,n.createElementBlock)("span",a,[(0,n.renderSlot)(e.$slots,"default")]))])}]])},246:(e,t,o)=>{o.d(t,{Z:()=>i});var n=o(1916),r={key:0},s=(0,n.createElementVNode)("div",{class:"font-medium text-red-600"},"Whoops! Something went wrong.",-1),a={class:"mt-3 list-disc list-inside text-sm text-red-600"};const l={computed:{errors:function(){return this.$page.props.errors},hasErrors:function(){return Object.keys(this.errors).length>0}}};const i=(0,o(3744).Z)(l,[["render",function(e,t,o,l,i,c){return c.hasErrors?((0,n.openBlock)(),(0,n.createElementBlock)("div",r,[s,(0,n.createElementVNode)("ul",a,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(c.errors,(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{key:t},(0,n.toDisplayString)(e),1)})),128))])])):(0,n.createCommentVNode)("",!0)}]])},9475:(e,t,o)=>{o.d(t,{Z:()=>g});var n=o(1916),r={class:"flex h-screen guest"},s={class:"w-full flex-col shadow-md flex items-center"},a={class:"flex justify-center items-center"},l=function(e){return(0,n.pushScopeId)("data-v-6f665f2c"),e=e(),(0,n.popScopeId)(),e}((function(){return(0,n.createElementVNode)("span",{class:"font-sans text-4xl subpixel-antialiased tracking-wider"},"SHOOT IT",-1)}));var i=o(7222),c=o(9038);const d={components:{ApplicationLogo:i.Z,Link:c.rU}};var u=o(3379),m=o.n(u),p=o(1050),f={insert:"head",singleton:!1};m()(p.Z,f);p.Z.locals;const g=(0,o(3744).Z)(d,[["render",function(e,t,o,i,c,d){var u=(0,n.resolveComponent)("ApplicationLogo");return(0,n.openBlock)(),(0,n.createElementBlock)("div",r,[(0,n.createElementVNode)("div",s,[(0,n.createElementVNode)("div",a,[(0,n.createVNode)(u,{class:"mb-10 mt-10 mr-5 w-20 h-20 fill-current text-gray-500"}),l]),(0,n.renderSlot)(e.$slots,"default",{},void 0,!0)])])}],["__scopeId","data-v-6f665f2c"]])},8294:(e,t,o)=>{o.r(t),o.d(t,{default:()=>f});var n=o(1916),r={class:"mt-4"},s={class:"mt-4"},a={class:"flex items-center justify-end mt-4"},l=(0,n.createTextVNode)(" Reset Password ");var i=o(2278),c=o(9475),d=o(7461),u=o(4503),m=o(246);const p={layout:c.Z,components:{BreezeButton:i.Z,BreezeInput:d.Z,BreezeLabel:u.Z,BreezeValidationErrors:m.Z},props:{email:String,token:String},data:function(){return{form:this.$inertia.form({token:this.token,email:this.email,password:"",password_confirmation:""})}},methods:{submit:function(){var e=this;this.form.post(this.route("password.update"),{onFinish:function(){return e.form.reset("password","password_confirmation")}})}}};const f=(0,o(3744).Z)(p,[["render",function(e,t,o,i,c,d){var u=(0,n.resolveComponent)("Head"),m=(0,n.resolveComponent)("BreezeValidationErrors"),p=(0,n.resolveComponent)("BreezeLabel"),f=(0,n.resolveComponent)("BreezeInput"),g=(0,n.resolveComponent)("BreezeButton");return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)(u,{title:"Reset Password"}),(0,n.createVNode)(m,{class:"mb-4"}),(0,n.createElementVNode)("form",{onSubmit:t[3]||(t[3]=(0,n.withModifiers)((function(){return d.submit&&d.submit.apply(d,arguments)}),["prevent"]))},[(0,n.createElementVNode)("div",null,[(0,n.createVNode)(p,{for:"email",value:"Email"}),(0,n.createVNode)(f,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:c.form.email,"onUpdate:modelValue":t[0]||(t[0]=function(e){return c.form.email=e}),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"])]),(0,n.createElementVNode)("div",r,[(0,n.createVNode)(p,{for:"password",value:"Password"}),(0,n.createVNode)(f,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:c.form.password,"onUpdate:modelValue":t[1]||(t[1]=function(e){return c.form.password=e}),required:"",autocomplete:"new-password"},null,8,["modelValue"])]),(0,n.createElementVNode)("div",s,[(0,n.createVNode)(p,{for:"password_confirmation",value:"Confirm Password"}),(0,n.createVNode)(f,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:c.form.password_confirmation,"onUpdate:modelValue":t[2]||(t[2]=function(e){return c.form.password_confirmation=e}),required:"",autocomplete:"new-password"},null,8,["modelValue"])]),(0,n.createElementVNode)("div",a,[(0,n.createVNode)(g,{class:(0,n.normalizeClass)({"opacity-25":c.form.processing}),disabled:c.form.processing},{default:(0,n.withCtx)((function(){return[l]})),_:1},8,["class","disabled"])])],32)],64)}]])}}]);
//# sourceMappingURL=294.js.map