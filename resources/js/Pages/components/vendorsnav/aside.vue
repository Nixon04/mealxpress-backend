<template>
    
      <aside class="aside-mealxpress">
        <div class="flex-wrap-container">
            <div class="aside-header">
                <h1 class="text-white fs-5">Mealxpress</h1>
            </div>
            <div class="aside-navigation">
                <ul class="ul-flex">
                    <Link href="/vendorspath/dashboard/home" class="mb-3">
                        <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/home' } ]">
                            <i class="fas fa-home mealxpress-icons" ></i>
                            Dashboard
                        </li>
                    </Link>

                    <Link href="/vendorspath/dashboard/addcategories" class="mb-3">
                        <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/addcategories' } ]">
                            <i class="fa-solid fa-feather-pointed mealxpress-icons" ></i>
                            Add categories
                        </li>
                    </Link>

                    <Link href="/vendorspath/dashboard/listproducts" class="mb-3">
                        <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/listproducts' } ]">
                            <i class="fas fa-paper-plane mealxpress-icons" ></i>
                            Products
                        </li>
                    </Link>





                    <Link href="/vendorspath/dashboard/orders" class="mb-4" replace>
                        <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/orders' } ]">
                            <i class="fa fa-store mealxpress-icons" ></i>
                            Orders
                        </li>
                    </Link>

                    <Link href="/vendorspath/dashboard/payouts" class="mb-4">
                        <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/payouts' } ]">
                            <i class="fa-regular fa fa-file-lines mealxpress-icons" ></i>
                            Payouts
                        </li>
                    </Link>

                    <Link href="/vendorspath/dashboard/settings" class="mb-4">
                        <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/settings' } ]">
                            <i class="fa fa-cog mealxpress-icons" ></i>
                           settings
                        </li>
                    </Link>


                </ul>
            </div>
            <div class="aside-footer">
                <div class="aside-centered">
                    <h1 class=" fs-2 text-white">Having troubles</h1>
                    <h6 class="fs-7 text-white">We are active 24/7</h6>
                </div>
            </div>
        </div>
      </aside>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default{
    components:{
        Link
    }
}
</script>


