var wc;(()=>{var e,t,o,r={3441:(e,t,o)=>{"use strict";o.r(t),o.d(t,{Button:()=>z,CheckboxControl:()=>Se.CheckboxControl,ExperimentalDiscountsMeta:()=>M,ExperimentalOrderLocalPickupPackages:()=>V,ExperimentalOrderMeta:()=>I,ExperimentalOrderShippingPackages:()=>F,Label:()=>J,Panel:()=>U,SlotFillProvider:()=>h.Kq,StoreNotice:()=>Ee,StoreNoticesContainer:()=>xe,Subtotal:()=>f,TextInput:()=>Ie,TotalsFees:()=>w,TotalsItem:()=>u,TotalsTaxes:()=>b,TotalsWrapper:()=>E,ValidatedTextInput:()=>je,ValidatedTextInputHandle:()=>r.ValidatedTextInputHandle,ValidationInputError:()=>Ce,__experimentalApplyCheckoutFilter:()=>Xe,__experimentalRegisterCheckoutFilters:()=>Ze,applyCheckoutFilter:()=>Qe,createSlotFill:()=>A,extensionCartUpdate:()=>Ve,getRegisteredBlocks:()=>rt,getValidityMessageForInput:()=>Me,hasInnerBlocks:()=>ot,hasValidFills:()=>N,innerBlockAreas:()=>et,isPostcode:()=>Le,mustContain:()=>Re,productPriceValidation:()=>$e,registerCheckoutBlock:()=>at,registerCheckoutFilters:()=>Ge,useSlot:()=>v.A,useSlotFills:()=>k.A});var r={};o.r(r),o.d(r,{A:()=>je});var n=o(1609),a=o(851),c=o(6087),s=(o(1157),o(6175));o(9297);const l=e=>{const t=(null==e?void 0:e.thousandSeparator)===(null==e?void 0:e.decimalSeparator);return t&&console.warn("Thousand separator and decimal separator are the same. This may cause formatting issues."),{thousandSeparator:t?"":null==e?void 0:e.thousandSeparator,decimalSeparator:null==e?void 0:e.decimalSeparator,fixedDecimalScale:!0,prefix:null==e?void 0:e.prefix,suffix:null==e?void 0:e.suffix,isNumericString:!0}},i=({className:e,value:t,currency:o,onValueChange:r,displayType:c="text",...i})=>{var m;const u="string"==typeof t?parseInt(t,10):t;if(!Number.isFinite(u))return null;const p=u/10**o.minorUnit;if(!Number.isFinite(p))return null;const d=(0,a.A)("wc-block-formatted-money-amount","wc-block-components-formatted-money-amount",e),f=null!==(m=i.decimalScale)&&void 0!==m?m:null==o?void 0:o.minorUnit,b={...i,...l(o),decimalScale:f,value:void 0,currency:void 0,onValueChange:void 0},w=r?e=>{const t=+e.value*10**o.minorUnit;r(t)}:()=>{};return(0,n.createElement)(s.A,{className:d,displayType:c,...b,value:p,onValueChange:w})},m=({value:e,currency:t})=>(0,c.isValidElement)(e)?(0,n.createElement)("div",{className:"wc-block-components-totals-item__value"},e):Number.isFinite(e)?(0,n.createElement)(i,{className:"wc-block-components-totals-item__value",currency:t||{},value:e}):null,u=({className:e,currency:t,label:o,value:r,description:c})=>(0,n.createElement)("div",{className:(0,a.A)("wc-block-components-totals-item",e)},(0,n.createElement)("span",{className:"wc-block-components-totals-item__label"},o),(0,n.createElement)(m,{value:r,currency:t}),(0,n.createElement)("div",{className:"wc-block-components-totals-item__description"},c));var p=o(7723);const d=window.wc.wcSettings,f=({currency:e,values:t,className:o})=>{const{total_items:r,total_items_tax:a}=t,c=parseInt(r,10),s=parseInt(a,10);return(0,n.createElement)(u,{className:o,currency:e,label:(0,p.__)("Subtotal","woocommerce"),value:(0,d.getSetting)("displayCartPricesIncludingTax",!1)?c+s:c})},b=({currency:e,values:t,className:o,showRateAfterTaxName:r})=>{const{total_tax:c,tax_lines:s}=t;if(!(0,d.getSetting)("taxesEnabled",!0)&&parseInt(c,10)<=0)return null;const l=(0,d.getSetting)("displayItemizedTaxes",!1),i=l&&s.length>0?(0,n.createElement)(n.Fragment,null,s.map((({name:t,rate:c,price:s},l)=>{const i=`${t}${r?` ${c}`:""}`;return(0,n.createElement)(u,{key:`tax-line-${l}`,className:(0,a.A)("wc-block-components-totals-taxes",o),currency:e,label:i,value:parseInt(s,10)})}))," "):null;return l?i:(0,n.createElement)(n.Fragment,null,(0,n.createElement)(u,{className:(0,a.A)("wc-block-components-totals-taxes",o),currency:e,label:(0,p.__)("Taxes","woocommerce"),value:parseInt(c,10),description:null}))},w=({currency:e,cartFees:t,className:o})=>(0,n.createElement)(n.Fragment,null,t.map((({id:t,key:r,name:c,totals:s},l)=>{const i=parseInt(s.total,10);if(!i)return null;const m=parseInt(s.total_tax,10);return(0,n.createElement)(u,{key:t||`${l}-${c}`,className:(0,a.A)("wc-block-components-totals-fees","wc-block-components-totals-fees__"+r,o),currency:e,label:c||(0,p.__)("Fee","woocommerce"),value:(0,d.getSetting)("displayCartPricesIncludingTax",!1)?i+m:i})})));o(7015);const E=({children:e,slotWrapper:t=!1,className:o})=>c.Children.count(e)?(0,n.createElement)("div",{className:(0,a.A)(o,"wc-block-components-totals-wrapper",{"slot-wrapper":t})},e):null;var h=o(3020),v=o(9689),k=o(3174),g=o(2294);class _ extends c.Component{constructor(...e){super(...e),(0,g.A)(this,"state",{errorMessage:"",hasError:!1})}static getDerivedStateFromError(e){return void 0!==e.statusText&&void 0!==e.status?{errorMessage:(0,n.createElement)(n.Fragment,null,(0,n.createElement)("strong",null,e.status),": "+e.statusText),hasError:!0}:{errorMessage:e.message,hasError:!0}}render(){const{renderError:e}=this.props,{errorMessage:t,hasError:o}=this.state;return o?"function"==typeof e?e(t):(0,n.createElement)("p",null,t):this.props.children}}const y=_,N=e=>Array.isArray(e)&&e.filter(Boolean).length>0,A=(e,t=null)=>{const{Fill:o,Slot:r}=(0,h.QJ)(e);return{Fill:({children:e})=>(0,n.createElement)(o,null,(o=>c.Children.map(e,(e=>(0,n.createElement)(y,{renderError:d.CURRENT_USER_IS_ADMIN?t:()=>null},(0,c.cloneElement)(e,o)))))),Slot:e=>(0,n.createElement)(r,{...e,bubblesVirtually:!0})}},x="__experimentalOrderMeta",{Fill:S,Slot:T}=A(x);S.Slot=({className:e,extensions:t,cart:o,context:r})=>{const c=(0,k.A)(x);return N(c)&&(0,n.createElement)(E,{slotWrapper:!0},(0,n.createElement)(T,{className:(0,a.A)(e,"wc-block-components-order-meta"),fillProps:{extensions:t,cart:o,context:r}}))};const I=S,O="__experimentalDiscountsMeta",{Fill:C,Slot:R}=A(O);C.Slot=({className:e,extensions:t,cart:o,context:r})=>{const c=(0,k.A)(O);return N(c)&&(0,n.createElement)(E,{slotWrapper:!0},(0,n.createElement)(R,{className:(0,a.A)(e,"wc-block-components-discounts-meta"),fillProps:{extensions:t,cart:o,context:r}}))};const M=C,{Fill:P,Slot:D}=A("__experimentalOrderShippingPackages");P.Slot=({className:e,noResultsMessage:t,renderOption:o,extensions:r,cart:c,components:s,context:l,collapsible:i,showItems:m})=>(0,n.createElement)(D,{className:(0,a.A)("wc-block-components-shipping-rates-control",e),fillProps:{collapse:i,collapsible:i,showItems:m,noResultsMessage:t,renderOption:o,extensions:r,cart:c,components:s,context:l}});const F=P,{Fill:L,Slot:$}=A("__experimentalOrderLocalPickupPackages");L.Slot=({extensions:e,cart:t,components:o,renderPickupLocation:r})=>(0,n.createElement)($,{className:(0,a.A)("wc-block-components-local-pickup-rates-control"),fillProps:{extensions:e,cart:t,components:o,renderPickupLocation:r}});const V=L;var B=o(7104),j=o(9813),H=o(224);o(5440);const U=({children:e,className:t,initialOpen:o=!1,hasBorder:r=!1,title:s,titleTag:l="div",state:i})=>{let[m,u]=(0,c.useState)(o);return Array.isArray(i)&&2===i.length&&([m,u]=i),(0,n.createElement)("div",{className:(0,a.A)(t,"wc-block-components-panel",{"has-border":r})},(0,n.createElement)(l,null,(0,n.createElement)("button",{"aria-expanded":m,className:"wc-block-components-panel__button",onClick:()=>u(!m)},(0,n.createElement)(B.A,{"aria-hidden":"true",className:"wc-block-components-panel__button-icon",icon:m?j.A:H.A}),s)),m&&(0,n.createElement)("div",{className:"wc-block-components-panel__content"},e))};var K=o(8165),W=o(4040),Y=o.n(W);o(2080),o(7791);const G=()=>(0,n.createElement)("span",{className:"wc-block-components-spinner","aria-hidden":"true"}),Z=(0,c.forwardRef)(((e,t)=>{"showSpinner"in e&&Y()("showSpinner prop",{version:"8.9.0",alternative:"Render a spinner in the button children instead.",plugin:"WooCommerce"});const{className:o,showSpinner:r=!1,children:c,variant:s="contained",removeTextWrap:l=!1,...i}=e,m=(0,a.A)("wc-block-components-button","wp-element-button",o,s,{"wc-block-components-button--loading":r});if("href"in e)return(0,n.createElement)(K.$,{render:(0,n.createElement)("a",{ref:t,href:e.href},r&&(0,n.createElement)(G,null),(0,n.createElement)("span",{className:"wc-block-components-button__text"},c)),className:m,...i});const u=l?e.children:(0,n.createElement)("span",{className:"wc-block-components-button__text"},e.children);return(0,n.createElement)(K.$,{ref:t,className:m,...i},r&&(0,n.createElement)(G,null),u)})),z=Z,q=({label:e,screenReaderLabel:t,wrapperElement:o,wrapperProps:r={}})=>{let s;const l=null!=e,i=null!=t;return!l&&i?(s=o||"span",r={...r,className:(0,a.A)(r.className,"screen-reader-text")},(0,n.createElement)(s,{...r},t)):(s=o||c.Fragment,l&&i&&e!==t?(0,n.createElement)(s,{...r},(0,n.createElement)("span",{"aria-hidden":"true"},e),(0,n.createElement)("span",{className:"screen-reader-text"},t)):(0,n.createElement)(s,{...r},e))},J=q,Q=window.wp.data,X=window.wc.wcBlocksData,ee=window.wc.wcTypes;let te=function(e){return e.CART="wc/cart",e.CHECKOUT="wc/checkout",e.PAYMENTS="wc/checkout/payments",e.EXPRESS_PAYMENTS="wc/checkout/express-payments",e.CONTACT_INFORMATION="wc/checkout/contact-information",e.SHIPPING_ADDRESS="wc/checkout/shipping-address",e.BILLING_ADDRESS="wc/checkout/billing-address",e.SHIPPING_METHODS="wc/checkout/shipping-methods",e.CHECKOUT_ACTIONS="wc/checkout/checkout-actions",e.ORDER_INFORMATION="wc/checkout/additional-information",e}({});(0,p.__)("Something went wrong. Please contact us to get assistance.","woocommerce"),o(6249);var oe=o(1359),re=o.n(oe);const ne=["a","b","em","i","strong","p","br"],ae=["target","href","rel","name","download"],ce=(e,t)=>{const o=(null==t?void 0:t.tags)||ne,r=(null==t?void 0:t.attr)||ae;return re().sanitize(e,{ALLOWED_TAGS:o,ALLOWED_ATTR:r})};function se(e,t){const o=(0,c.useRef)();return(0,c.useEffect)((()=>{o.current===e||t&&!t(e,o.current)||(o.current=e)}),[e,t]),o.current}const le=window.wp.htmlEntities;var ie=o(1208),me=(o(9345),o(2900)),ue=o(2478),pe=o(8306);const de=e=>{switch(e){case"success":case"warning":case"info":case"default":return"polite";default:return"assertive"}},fe=e=>{switch(e){case"success":return me.A;case"warning":case"info":case"error":return ue.A;default:return pe.A}};var be=o(195);const we=({className:e,status:t="default",children:o,spokenMessage:r=o,onRemove:s=(()=>{}),isDismissible:l=!0,politeness:i=de(t),summary:m})=>(((e,t)=>{const o="string"==typeof e?e:(0,c.renderToString)(e);(0,c.useEffect)((()=>{o&&(0,be.speak)(o,t)}),[o,t])})(r,i),(0,n.createElement)("div",{className:(0,a.A)(e,"wc-block-components-notice-banner","is-"+t,{"is-dismissible":l})},(0,n.createElement)(B.A,{icon:fe(t)}),(0,n.createElement)("div",{className:"wc-block-components-notice-banner__content"},m&&(0,n.createElement)("p",{className:"wc-block-components-notice-banner__summary"},m),o),!!l&&(0,n.createElement)(Z,{className:"wc-block-components-notice-banner__dismiss","aria-label":(0,p.__)("Dismiss this notice","woocommerce"),onClick:e=>{"function"==typeof(null==e?void 0:e.preventDefault)&&e.preventDefault&&e.preventDefault(),s()},removeTextWrap:!0},(0,n.createElement)(B.A,{icon:ie.A})))),Ee=({className:e,children:t,status:o,...r})=>(0,n.createElement)(we,{className:(0,a.A)("wc-block-store-notice",e),status:o,...r},t),he=({className:e,notices:t})=>{const o=(0,c.useRef)(null),{removeNotice:r}=(0,Q.useDispatch)("core/notices"),s=t.map((e=>e.id)),l=se(s);(0,c.useEffect)((()=>{const e=o.current;if(!e)return;const t=e.ownerDocument.activeElement;t&&-1!==["input","select","button","textarea"].indexOf(t.tagName.toLowerCase())&&"radio"!==t.getAttribute("type")||s.filter((e=>!l||!l.includes(e))).length&&null!=e&&e.scrollIntoView&&e.scrollIntoView({behavior:"smooth"})}),[s,l,o]);const i=t.filter((({isDismissible:e})=>!!e)),m=t.filter((({isDismissible:e})=>!e)),u={error:i.filter((({status:e})=>"error"===e)),success:i.filter((({status:e})=>"success"===e)),warning:i.filter((({status:e})=>"warning"===e)),info:i.filter((({status:e})=>"info"===e)),default:i.filter((({status:e})=>"default"===e))};return(0,n.createElement)("div",{ref:o,className:(0,a.A)(e,"wc-block-components-notices")},m.map((e=>(0,n.createElement)(Ee,{key:e.id+"-"+e.context,...e},(0,n.createElement)(c.RawHTML,null,ce((0,le.decodeEntities)(e.content)))))),Object.entries(u).map((([e,t])=>{if(!t.length)return null;const o=t.filter(((e,t,o)=>o.findIndex((t=>t.content===e.content))===t)).map((e=>({...e,content:ce((0,le.decodeEntities)(e.content))}))),a={key:`store-notice-${e}`,status:e,onRemove:()=>{t.forEach((e=>{r(e.id,e.context)}))}};return 1===o.length?(0,n.createElement)(Ee,{...a},(0,n.createElement)(c.RawHTML,null,t[0].content)):(0,n.createElement)(Ee,{...a,summary:"error"===e?(0,p.__)("Please fix the following errors before continuing","woocommerce"):""},(0,n.createElement)("ul",null,o.map((e=>(0,n.createElement)("li",{key:e.id+"-"+e.context},(0,n.createElement)(c.RawHTML,null,e.content))))))})))};var ve=o(9491),ke=o(9910),ge=o(6648);o(230);const _e=({onRemove:e=(()=>{}),children:t,listRef:o,className:r,...s})=>((0,c.useEffect)((()=>{const t=setTimeout((()=>{e()}),1e4);return()=>clearTimeout(t)}),[e]),(0,n.createElement)(we,{className:(0,a.A)(r,"wc-block-components-notice-snackbar"),...s,onRemove:()=>{o&&o.current&&o.current.focus(),e()}},t)),ye=({notices:e,className:t,onRemove:o=(()=>{})})=>{const r=(0,c.useRef)(null),s=(0,ve.useReducedMotion)(),l=e=>()=>o((null==e?void 0:e.id)||"");return(0,n.createElement)("div",{className:(0,a.A)(t,"wc-block-components-notice-snackbar-list"),tabIndex:-1,ref:r},s?e.map((e=>{const{content:t,...o}=e;return(0,n.createElement)(_e,{...o,onRemove:l(e),listRef:r,key:e.id},e.content)})):(0,n.createElement)(ke.A,null,e.map((e=>{const{content:t,...o}=e;return(0,n.createElement)(ge.A,{key:"snackbar-"+e.id,timeout:500,classNames:"notice-transition"},(0,n.createElement)(_e,{...o,onRemove:l(e),listRef:r},t))}))))},Ne=({className:e,notices:t})=>{const{removeNotice:o}=(0,Q.useDispatch)("core/notices");return(0,n.createElement)(ye,{className:(0,a.A)(e,"wc-block-components-notices__snackbar"),notices:t,onRemove:e=>{t.forEach((t=>{t.explicitDismiss&&t.id===e?o(t.id,t.context):t.explicitDismiss||o(t.id,t.context)}))}})},Ae=(e,t)=>e.map((e=>({...e,context:t}))),xe=({className:e="",context:t="",additionalNotices:o=[]})=>{const{registerContainer:r,unregisterContainer:a}=(0,Q.useDispatch)(X.STORE_NOTICES_STORE_KEY),{suppressNotices:s,registeredContainers:l}=(0,Q.useSelect)((e=>({suppressNotices:e(X.PAYMENT_STORE_KEY).isExpressPaymentMethodActive(),registeredContainers:e(X.STORE_NOTICES_STORE_KEY).getRegisteredContainers()}))),i=(0,c.useMemo)((()=>Array.isArray(t)?t:[t]),[t]),m=Object.values(te).filter((e=>i.some((t=>e.includes(t+"/")))&&!l.includes(e))),u=(0,Q.useSelect)((e=>{const{getNotices:t}=e("core/notices");return[...m.flatMap((e=>Ae(t(e),e))),...i.flatMap((e=>Ae(t(e).concat(o),e)))].filter(Boolean)}));return(0,c.useEffect)((()=>(i.map((e=>r(e))),()=>{i.map((e=>a(e)))})),[i,r,a]),s?null:(0,n.createElement)(n.Fragment,null,(0,n.createElement)(he,{className:e,notices:u.filter((e=>"default"===e.type))}),(0,n.createElement)(Ne,{className:e,notices:u.filter((e=>"snackbar"===e.type))}))},Se=window.wc.blocksComponents;o(4632);const Te=(0,c.forwardRef)((({className:e,id:t,type:o="text",ariaLabel:r,ariaDescribedBy:s,label:l,screenReaderLabel:i,disabled:m,help:u,autoCapitalize:p="off",autoComplete:d="off",value:f="",onChange:b,required:w=!1,onBlur:E=(()=>{}),feedback:h,...v},k)=>{const[g,_]=(0,c.useState)(!1);return(0,n.createElement)("div",{className:(0,a.A)("wc-block-components-text-input",e,{"is-active":g||f})},(0,n.createElement)("input",{type:o,id:t,value:(0,le.decodeEntities)(f),ref:k,autoCapitalize:p,autoComplete:d,onChange:e=>{b(e.target.value)},onFocus:()=>_(!0),onBlur:e=>{E(e.target.value),_(!1)},"aria-label":r||l,disabled:m,"aria-describedby":u&&!s?t+"__help":s,required:w,...v}),(0,n.createElement)(q,{label:l,screenReaderLabel:i||l,wrapperElement:"label",wrapperProps:{htmlFor:t},htmlFor:t}),!!u&&(0,n.createElement)("p",{id:t+"__help",className:"wc-block-components-text-input__help"},u),h)})),Ie=Te;o(7235);const Oe=({errorMessage:e="",propertyName:t="",elementId:o=""})=>{const{validationError:r,validationErrorId:a}=(0,Q.useSelect)((e=>{const r=e(X.VALIDATION_STORE_KEY);return{validationError:r.getValidationError(t),validationErrorId:r.getValidationErrorId(o)}}));if(!e||"string"!=typeof e){if(null==r||!r.message||null!=r&&r.hidden)return null;e=r.message}return(0,n.createElement)("div",{className:"wc-block-components-validation-error",role:"alert"},(0,n.createElement)("p",{id:a},e))},Ce=Oe,Re=(e,t)=>{if(!e.includes(t))throw Error((0,p.sprintf)(/* translators: %1$s value passed to filter, %2$s : value that must be included. */ /* translators: %1$s value passed to filter, %2$s : value that must be included. */
(0,p.__)('Returned value must include %1$s, you passed "%2$s"',"woocommerce"),t,e));return!0},Me=(e,t)=>{const{valid:o,customError:r,valueMissing:n,badInput:a,typeMismatch:c}=t.validity;if(o||r)return t.validationMessage;const s=(0,p.sprintf)(/* translators: %s field label */ /* translators: %s field label */
(0,p.__)("Please enter a valid %s","woocommerce"),e.toLowerCase());return n||a||c?s:t.validationMessage||s};var Pe=o(4177);const De=new Map([["BA",/^([7-8]{1})([0-9]{4})$/],["GB",/^([A-Z]){1}([0-9]{1,2}|[A-Z][0-9][A-Z]|[A-Z][0-9]{2}|[A-Z][0-9]|[0-9][A-Z]){1}([ ])?([0-9][A-Z]{2}){1}|BFPO(?:\s)?([0-9]{1,4})$|BFPO(c\/o[0-9]{1,3})$/i],["IN",/^[1-9]{1}[0-9]{2}\s{0,1}[0-9]{3}$/],["JP",/^([0-9]{3})([-]?)([0-9]{4})$/],["KH",/^[0-9]{6}$/],["LI",/^(94[8-9][0-9])$/],["NI",/^[1-9]{1}[0-9]{4}$/],["NL",/^([1-9][0-9]{3})(\s?)(?!SA|SD|SS)[A-Z]{2}$/i],["SI",/^([1-9][0-9]{3})$/]]),Fe=new Map([...Pe.O,...De]),Le=({postcode:e,country:t})=>{var o;const r=null===(o=Fe.get(t))||void 0===o?void 0:o.test(e);return void 0===r||r},$e=e=>Re(e,"<price/>"),Ve=((0,p.__)("Unable to get cart data from the API.","woocommerce"),e=>{const{applyExtensionCartUpdate:t}=(0,Q.dispatch)("wc/store/cart");return t(e)}),Be=(0,c.forwardRef)((({className:e,id:t,type:o="text",ariaDescribedBy:r,errorId:s,focusOnMount:l=!1,onChange:i,showError:m=!0,errorMessage:u="",value:p="",customValidation:d=(()=>!0),customFormatter:f=(e=>e),label:b,validateOnMount:w=!0,instanceId:E="",...h},v)=>{const[k,g]=(0,c.useState)(!0),_=se(p),y=(0,c.useRef)(null),N=(0,ve.useInstanceId)(Be,"",E),A=void 0!==t?t:"textinput-"+N,x=void 0!==s?s:A,{setValidationErrors:S,hideValidationError:T,clearValidationError:I}=(0,Q.useDispatch)(X.VALIDATION_STORE_KEY),O=(0,c.useRef)(d);(0,c.useEffect)((()=>{O.current=d}),[d]);const{validationError:C,validationErrorId:R}=(0,Q.useSelect)((e=>{const t=e(X.VALIDATION_STORE_KEY);return{validationError:t.getValidationError(x),validationErrorId:t.getValidationErrorId(x)}})),M=(0,c.useCallback)(((e=!0)=>{const t=y.current||null;null!==t&&(t.value=t.value.trim(),t.setCustomValidity(""),t.checkValidity()&&O.current(t)?I(x):S({[x]:{message:b?Me(b,t):t.validationMessage,hidden:e}}))}),[I,x,S,b]);(0,c.useImperativeHandle)(v,(function(){return{revalidate(){M(!p)}}}),[M,p]),(0,c.useEffect)((()=>{var e,t;if(p!==_&&(p||_)&&y&&null!==y.current&&(null===(e=y.current)||void 0===e||null===(t=e.ownerDocument)||void 0===t?void 0:t.activeElement)!==y.current){const e=f(y.current.value);e!==p?i(e):M(!0)}}),[M,f,p,_,i]),(0,c.useEffect)((()=>{var e;k&&(g(!1),l&&(null===(e=y.current)||void 0===e||e.focus()),!w&&l||M(!0))}),[w,l,k,g,M]),(0,c.useEffect)((()=>()=>{I(x)}),[I,x]),""!==u&&(0,ee.isObject)(C)&&(C.message=u);const P=(null==C?void 0:C.message)&&!(null!=C&&C.hidden),D=m&&P&&R?R:r;return(0,n.createElement)(Ie,{className:(0,a.A)(e,{"has-error":P}),"aria-invalid":!0===P,id:A,type:o,feedback:m?(0,n.createElement)(Oe,{errorMessage:u,propertyName:x}):null,ref:y,onChange:e=>{T(x),M(!0);const t=f(e);t!==p&&i(t)},onBlur:()=>M(!1),ariaDescribedBy:D,value:p,title:"",label:b,...h})})),je=Be;var He=o(923),Ue=o.n(He);const Ke=()=>!0;let We={},Ye={};const Ge=(e,t)=>{Object.keys(t).includes("couponName")&&Y()("couponName",{alternative:"coupons",plugin:"WooCommerce Blocks",link:"https://github.com/woocommerce/woocommerce-gutenberg-products-block/blob/bb921d21f42e21f38df2b1c87b48e07aa4cb0538/docs/extensibility/available-filters.md#coupons"}),Ye={},We={...We,[e]:t}},Ze=(e,t)=>{Y()("__experimentalRegisterCheckoutFilters",{alternative:"registerCheckoutFilters",plugin:"WooCommerce Blocks",link:"https://github.com/woocommerce/woocommerce-blocks/pull/8346",since:"9.6.0",hint:"__experimentalRegisterCheckoutFilters has graduated to stable and this experimental function will be removed."}),Ge(e,t)},ze={},qe=(e,t,o,r)=>{ze[e]={arg:t,extensions:o,defaultValue:r}},Je=(e,t)=>!(!(0,ee.isNull)(e)||!(0,ee.isNull)(t))||(0,ee.isObject)(e)&&(0,ee.isObject)(t)&&Object.keys(e).length===Object.keys(t).length&&Object.keys(e).every((o=>(0,ee.objectHasProp)(t,o)&&Ue()(e[o],t[o]))),Qe=({filterName:e,defaultValue:t,extensions:o=null,arg:r=null,validation:n=Ke})=>{if(!((e,t,o,r)=>{const n=ze[e];if(!n)return qe(e,t,o,r),!0;const{arg:a={},extensions:c={},defaultValue:s=null}=n;return Je(t,a)?!(r===s&&Je(o,c)||(qe(e,t,o,r),0)):(qe(e,t,o,r),!0)})(e,r,o,t)&&void 0!==Ye[e])return Ye[e];const a=(e=>Object.keys(We).map((t=>We[t][e])).filter(Boolean))(e);let c=t;return a.forEach((e=>{try{const t=e(c,o||{},r);if(typeof t!=typeof c)throw new Error((0,p.sprintf)(/* translators: %1$s is the type of the variable passed to the filter function, %2$s is the type of the value returned by the filter function. */ /* translators: %1$s is the type of the variable passed to the filter function, %2$s is the type of the value returned by the filter function. */
(0,p.__)("The type returned by checkout filters must be the same as the type they receive. The function received %1$s but returned %2$s.","woocommerce"),typeof c,typeof t));c=n(t)?t:c}catch(e){if(d.CURRENT_USER_IS_ADMIN)throw e;console.error(e)}})),Ye[e]=c,c},Xe=({filterName:e,defaultValue:t,extensions:o=null,arg:r=null,validation:n=Ke})=>(Y()("__experimentalApplyCheckoutFilter",{alternative:"applyCheckoutFilter",plugin:"WooCommerce Blocks",link:"https://github.com/woocommerce/woocommerce-blocks/pull/8346",since:"9.6.0",hint:"__experimentalApplyCheckoutFilter has graduated to stable and this experimental function will be removed."}),Qe({filterName:e,defaultValue:t,extensions:o,arg:r,validation:n}));let et=function(e){return e.CHECKOUT="woocommerce/checkout",e.CHECKOUT_FIELDS="woocommerce/checkout-fields-block",e.CHECKOUT_TOTALS="woocommerce/checkout-totals-block",e.CONTACT_INFORMATION="woocommerce/checkout-contact-information-block",e.SHIPPING_ADDRESS="woocommerce/checkout-shipping-address-block",e.BILLING_ADDRESS="woocommerce/checkout-billing-address-block",e.SHIPPING_METHOD="woocommerce/checkout-shipping-method-block",e.SHIPPING_METHODS="woocommerce/checkout-shipping-methods-block",e.PICKUP_LOCATION="woocommerce/checkout-pickup-options-block",e.PAYMENT_METHODS="woocommerce/checkout-payment-methods-block",e.CART="woocommerce/cart",e.EMPTY_CART="woocommerce/empty-cart-block",e.FILLED_CART="woocommerce/filled-cart-block",e.CART_ITEMS="woocommerce/cart-items-block",e.CART_CROSS_SELLS="woocommerce/cart-cross-sells-block",e.CART_TOTALS="woocommerce/cart-totals-block",e.MINI_CART="woocommerce/mini-cart-contents",e.EMPTY_MINI_CART="woocommerce/empty-mini-cart-contents-block",e.FILLED_MINI_CART="woocommerce/filled-mini-cart-contents-block",e.MINI_CART_TITLE="woocommerce/mini-cart-title-block",e.MINI_CART_ITEMS="woocommerce/mini-cart-items-block",e.MINI_CART_FOOTER="woocommerce/mini-cart-footer-block",e.CART_ORDER_SUMMARY="woocommerce/cart-order-summary-block",e.CART_ORDER_SUMMARY_TOTALS="woocommerce/cart-order-summary-totals-block",e.CHECKOUT_ORDER_SUMMARY="woocommerce/checkout-order-summary-block",e.CHECKOUT_ORDER_SUMMARY_TOTALS="woocommerce/checkout-order-summary-totals-block",e}({});const tt={},ot=e=>Object.values(et).includes(e),rt=e=>ot(e)?Object.values(tt).filter((({metadata:t})=>((null==t?void 0:t.parent)||[]).includes(e))):[],nt=window.wc.wcBlocksRegistry,at=e=>{var t,o,r,n;((e,t,o)=>{if(!(0,ee.isObject)(e))return;const r=typeof e[t];if(r!==o)throw new Error(`Incorrect value for the ${t} argument when registering a block component. It was a ${r}, but must be a ${o}.`)})(e,"metadata","object"),(e=>{if(((e,t,o)=>{const r=typeof t;if(r!==o)throw new Error(`Incorrect value for the blockName argument when registering a checkout block. It was a ${r}, but must be a ${o}.`)})(0,e,"string"),!e)throw new Error("Value for the blockName argument must not be empty.")})(e.metadata.name),(e=>{if("string"!=typeof e&&!Array.isArray(e))throw new Error(`Incorrect value for the parent argument when registering a checkout block. It was a ${typeof e}, but must be a string or array of strings.`);if("string"==typeof e&&!ot(e))throw new Error("When registering a checkout block, the parent must be a valid inner block area.");if(Array.isArray(e)&&!e.some((e=>ot(e))))throw new Error("When registering a checkout block, the parent must be a valid inner block area.")})(e.metadata.parent),((e,t)=>{const o=e[t];if(o){if("function"==typeof o)return;if((0,ee.isObject)(o)&&o.$$typeof&&o.$$typeof===Symbol.for("react.lazy"))return}throw new Error(`Incorrect value for the ${t} argument when registering a block component. Component must be a valid React Element or Lazy callback.`)})(e,"component"),(0,nt.registerBlockComponent)({blockName:e.metadata.name,component:e.component});const a="boolean"==typeof e.force?e.force:Boolean(null===(t=e.metadata)||void 0===t||null===(o=t.attributes)||void 0===o||null===(r=o.lock)||void 0===r||null===(n=r.default)||void 0===n?void 0:n.remove);tt[e.metadata.name]={blockName:e.metadata.name,metadata:e.metadata,component:e.component,force:a}}},2080:()=>{},9345:()=>{},230:()=>{},9297:()=>{},5440:()=>{},7791:()=>{},6249:()=>{},4632:()=>{},7015:()=>{},1157:()=>{},7235:()=>{},1609:e=>{"use strict";e.exports=window.React},5795:e=>{"use strict";e.exports=window.ReactDOM},195:e=>{"use strict";e.exports=window.wp.a11y},9491:e=>{"use strict";e.exports=window.wp.compose},4040:e=>{"use strict";e.exports=window.wp.deprecated},6087:e=>{"use strict";e.exports=window.wp.element},7723:e=>{"use strict";e.exports=window.wp.i18n},923:e=>{"use strict";e.exports=window.wp.isShallowEqual},5573:e=>{"use strict";e.exports=window.wp.primitives},979:e=>{"use strict";e.exports=window.wp.warning}},n={};function a(e){var t=n[e];if(void 0!==t)return t.exports;var o=n[e]={exports:{}};return r[e].call(o.exports,o,o.exports,a),o.exports}a.m=r,e=[],a.O=(t,o,r,n)=>{if(!o){var c=1/0;for(m=0;m<e.length;m++){for(var[o,r,n]=e[m],s=!0,l=0;l<o.length;l++)(!1&n||c>=n)&&Object.keys(a.O).every((e=>a.O[e](o[l])))?o.splice(l--,1):(s=!1,n<c&&(c=n));if(s){e.splice(m--,1);var i=r();void 0!==i&&(t=i)}}return t}n=n||0;for(var m=e.length;m>0&&e[m-1][2]>n;m--)e[m]=e[m-1];e[m]=[o,r,n]},a.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return a.d(t,{a:t}),t},o=Object.getPrototypeOf?e=>Object.getPrototypeOf(e):e=>e.__proto__,a.t=function(e,r){if(1&r&&(e=this(e)),8&r)return e;if("object"==typeof e&&e){if(4&r&&e.__esModule)return e;if(16&r&&"function"==typeof e.then)return e}var n=Object.create(null);a.r(n);var c={};t=t||[null,o({}),o([]),o(o)];for(var s=2&r&&e;"object"==typeof s&&!~t.indexOf(s);s=o(s))Object.getOwnPropertyNames(s).forEach((t=>c[t]=()=>e[t]));return c.default=()=>e,a.d(n,c),n},a.d=(e,t)=>{for(var o in t)a.o(t,o)&&!a.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},a.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),a.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.j=8157,(()=>{var e={8157:0};a.O.j=t=>0===e[t];var t=(t,o)=>{var r,n,[c,s,l]=o,i=0;if(c.some((t=>0!==e[t]))){for(r in s)a.o(s,r)&&(a.m[r]=s[r]);if(l)var m=l(a)}for(t&&t(o);i<c.length;i++)n=c[i],a.o(e,n)&&e[n]&&e[n][0](),e[n]=0;return a.O(m)},o=self.webpackChunkwebpackWcBlocksFrontendJsonp=self.webpackChunkwebpackWcBlocksFrontendJsonp||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var c=a.O(void 0,[94],(()=>a(3441)));c=a.O(c),(wc=void 0===wc?{}:wc).blocksCheckout=c})();