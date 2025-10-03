document.addEventListener('DOMContentLoaded', function(){
  const sidebar = document.getElementById('sidebar');
  const toggle = document.getElementById('sidebarToggle');
  const mainContent = document.querySelector('.main-content');
  
  if(toggle && sidebar && mainContent){
    toggle.addEventListener('click', function(){
      sidebar.classList.toggle('hidden');
      mainContent.classList.toggle('full');
    });
  }
});
