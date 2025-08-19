<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const props = defineProps<{
  clients: { data: any[], links: any[], meta: any },
  filters: { search?: string|null, per_page?: number|null }
}>()

const search = ref(props.filters.search ?? '')
const perPage = ref(props.filters.per_page ?? 10)

let t: any
watch([search, perPage], () => {
  clearTimeout(t)
  t = setTimeout(() => {
    router.get(route('clients.index'), { search: search.value, per_page: perPage.value }, { preserveState: true, replace: true })
  }, 300)
})
</script>

<template>
  <AppLayout>
    <div class="flex items-center justify-between mb-4">
      <div class="flex gap-2">
        <input v-model="search" placeholder="Buscar nombre/email/CC" class="border p-2 rounded w-72" />
        <select v-model="perPage" class="border p-2 rounded">
          <option :value="10">10</option>
          <option :value="25">25</option>
          <option :value="50">50</option>
        </select>
      </div>
      <Link :href="route('clients.create')" class="bg-blue-600 text-white px-3 py-2 rounded">Nuevo</Link>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
      <table class="w-full">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-2 text-left">Nombre</th>
            <th class="p-2">Email</th>
            <th class="p-2">Teléfono</th>
            <th class="p-2">Documento</th>
            <th class="p-2">Ciudad</th>
            <th class="p-2">Estado</th>
            <th class="p-2"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="c in props.clients.data" :key="c.id" class="border-t">
            <td class="p-2 text-left">{{ c.name }}</td>
            <td class="p-2 text-center">{{ c.email ?? '—' }}</td>
            <td class="p-2 text-center">{{ c.phone ?? '—' }}</td>
            <td class="p-2 text-center">{{ c.document_number ?? '—' }}</td>
            <td class="p-2 text-center">{{ c.city ?? '—' }}</td>
            <td class="p-2 text-center">
              <span :class="c.status === 'active' ? 'text-green-600' : 'text-gray-500'">{{ c.status }}</span>
            </td>
            <td class="p-2 text-right">
              <Link :href="route('clients.edit', c.id)" class="text-blue-600 mr-2">Editar</Link>
              <Link as="button" method="delete" :href="route('clients.destroy', c.id)" class="text-red-600">Eliminar</Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Paginación -->
    <div class="flex gap-1 mt-4">
      <Link v-for="l in props.clients.links" :key="l.url ?? l.label" :href="l.url || ''"
            class="px-3 py-1 border rounded"
            :class="{'bg-gray-800 text-white': l.active, 'opacity-50 pointer-events-none': !l.url}"
            v-html="l.label"/>
    </div>
  </AppLayout>
</template>