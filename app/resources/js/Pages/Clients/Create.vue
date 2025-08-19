<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
  name: '', email: '', phone: '', document_number: '',
  address: '', city: '', status: 'active', notes: ''
})

function submit() { form.post(route('clients.store')) }
</script>

<template>
  <AppLayout>
    <div class="max-w-2xl bg-white p-6 rounded shadow">
      <h1 class="text-xl font-semibold mb-4">Nuevo cliente</h1>
      <form @submit.prevent="submit" class="grid grid-cols-2 gap-4">
        <input v-model="form.name" class="border p-2 rounded col-span-2" placeholder="Nombre *" />
        <input v-model="form.email" class="border p-2 rounded" placeholder="Email" type="email" />
        <input v-model="form.phone" class="border p-2 rounded" placeholder="Teléfono" />
        <input v-model="form.document_number" class="border p-2 rounded" placeholder="Documento/NIT" />
        <input v-model="form.address" class="border p-2 rounded col-span-2" placeholder="Dirección" />
        <input v-model="form.city" class="border p-2 rounded" placeholder="Ciudad" />
        <select v-model="form.status" class="border p-2 rounded">
          <option value="active">Activo</option>
          <option value="inactive">Inactivo</option>
        </select>
        <textarea v-model="form.notes" class="border p-2 rounded col-span-2" rows="3" placeholder="Notas"></textarea>

        <div class="col-span-2 flex justify-end gap-2">
          <Link :href="route('clients.index')" class="px-3 py-2">Cancelar</Link>
          <button class="bg-blue-600 text-white px-3 py-2 rounded" :disabled="form.processing">Guardar</button>
        </div>

        <div v-if="form.errors" class="col-span-2 text-red-600 text-sm">
          <div v-for="(msg, field) in form.errors" :key="field">{{ msg }}</div>
        </div>
      </form>
    </div>
  </AppLayout>
</template>