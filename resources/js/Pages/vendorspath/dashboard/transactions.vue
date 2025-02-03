<template>
    <div class="main-board-mealxpress">
        <NavbarComponent />
        <div class="mealxpress-content">
          <HeaderDashboard/>
          <div class="mealxpress-main">
          <!--  -->

          <!-- Fixed Columns -->
            <div class="card">
              <h5 class="card-header">Fixed Columns</h5>
              <div class="card-datatable text-nowrap">
                <table class="dt-fixedcolumns table table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Email</th>
                      <th>City</th>
                      <th>Date</th>
                      <th>Salary</th>
                      <th>Age</th>
                      <th>Experience</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
<!--/ Fixed Columns -->

          <!--  -->
         </div>
        </div>
    </div>  

</template>

<script>
  import NavbarComponent from './../../components/vendorsnav/aside.vue';
  import Navigation from './../../components/vendorsnav/navigation.vue';
  import HeaderDashboard from './../../components/vendorsnav/header.vue';
export default{
    components:{
        NavbarComponent,
        HeaderDashboard,
    }
}
</script>