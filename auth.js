async function sessionLabel(){
  try{
    const r=await fetch("backend/api/me.php",{credentials:"same-origin"});
    if(!r.ok)return "";
    const data=await r.json();
    if(!data.authenticated)return "";
    const d=new Date(data.connected_at);
    return "Connexion active depuis le "+d.toLocaleString("fr-FR")+" — identifiant : "+data.username;
  }catch(e){ return ""; }
}
async function logout(){
  await fetch("backend/api/logout.php",{method:"POST",credentials:"same-origin"});
  window.location.href="index.html";
}
