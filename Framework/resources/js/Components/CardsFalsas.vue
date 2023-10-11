<template>
    <div class="flex flex-col md:flex md:flex-row -mx-3 px-7 pt-2 pb-8 ">
        <div class="bg-gray-200 w-full md:w-1/4 px-3 mb-6 mx-2 md:mb-0 rounded-lg border-gray-300 shadow card">
            <div class="flex flex-row h-14">
                <i class="fa-solid fa-cash-register mr-3"></i>
                <h3 class="font-semibold text-1xl text-gray-600">Ventas del día</h3>
            </div>

            <p class="font-bold text-center text-4xl text-gray-600">{{ ventasDia }}</p>
        </div>

        <div class="bg-gray-200  md:w-1/4 w-full px-3 mb-6 mx-2 md:mb-0 rounded-lg border border-gray-300 shadow card">
            <div class="flex flex-row h-14">
                <i class="fa-solid fa-cart-shopping mr-3"></i>
                <h3 class="font-semibold text-1xl text-gray-600">Producto más vendido</h3>
            </div>

            <p class="font-bold text-center text-2xl text-gray-600">{{ productoMasVendido }}</p>
        </div>

        <div class="bg-gray-200  md:w-1/4 w-full px-3 mb-6 mx-2 md:mb-0 rounded-lg border border-gray-300 shadow card">
            <div class="flex flex-row h-14">
                <i class="fa-solid fa-chart-simple mr-3"></i>
                <h3 class="font-semibold text-1xl text-gray-600">Ventas del mes</h3>
            </div>

            <p class="font-bold text-center text-4xl text-gray-600">{{ VentasDelMes }}</p>
        </div>

        <div class="bg-gray-200  md:w-1/4 w-full px-3 mb-6 mx-2 md:mb-0 rounded-lg border border-gray-300 shadow card">
            <div class="flex flex-row h-14">
                <i class="fa-solid fa-users mr-3"></i>
                <h3 class="font-semibold text-1xl text-gray-600">Top usuarios</h3>
            </div>
            <ul>

                <li v-for="(usuario, index) in topUsuarios" :key="index" class="font-bold text-center text-2xl text-gray-600">
                    {{ usuario.nombre }} - {{ usuario.compras }}
                </li>

            </ul>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            ventasDia: 100,
            productoMasVendido: 'Producto X',
            VentasDelMes: 530,
            topUsuarios: [
                { nombre: 'Usuario A', compras: 10 },
                { nombre: 'Usuario B', compras: 8 },
                { nombre: 'Usuario C', compras: 6 },
            ],
        };
    },
};
</script>
  
<style scoped>
.card {
    padding: 20px;
    margin-bottom: 20px;
}
</style>