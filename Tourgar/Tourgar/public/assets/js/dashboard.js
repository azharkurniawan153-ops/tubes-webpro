// animasi scroll sederhana
document.querySelectorAll("button").forEach(btn=>{
btn.addEventListener("mouseover",function(){
this.style.transform="scale(1.05)";
});

btn.addEventListener("mouseout",function(){
this.style.transform="scale(1)";
});
});