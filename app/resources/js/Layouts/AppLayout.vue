<script setup>
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navbar -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold">Mi Aplicación</h1>
      </div>
    </header>

    <!-- Contenido -->
    <main>
      <slot />
    </main>
  </div>
</template>