document.addEventListener("DOMContentLoaded",()=>{
  const form=document.getElementById("empleadoForm");
  if(!form) return;
  form.addEventListener("submit",e=>{
    const nombre=form.nombre.value.trim();
    const email=form.email.value.trim();
    const sexo=form.querySelector("input[name='sexo']:checked");
    const area=form.area_id.value;
    const rol=form.rol_id.value;
    if(nombre.length<2){alert("Nombre muy corto");e.preventDefault();}
    else if(!/^\S+@\S+\.\S+$/.test(email)){alert("Email inválido");e.preventDefault();}
    else if(!sexo){alert("Selecciona sexo");e.preventDefault();}
    else if(!area){alert("Selecciona área");e.preventDefault();}
  });
});
