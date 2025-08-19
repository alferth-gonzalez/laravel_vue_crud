<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps<{ client: any }>()

const form = useForm({
  name: props.client.name, email: props.client.email, phone: props.client.phone,
  document_number: props.client.document_number, address: props.client.address,
  city: props.client.city, status: props.client.status, notes: props.client.notes
})

function submit() {
  form.put(route('clients.update', props.client.id))
}
</script>

<template>
  <AppLayout>
    <div class="max-w-2xl bg-white p-6 rounded shadow">
      <h1 class="text-xl font-semibold mb-4">Editar cliente</h1>
      <form @submit.prevent="submit" class="grid grid-cols-2 gap-4">
        <!-- mismos campos que Create.vue -->
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
          <Link :href="route('clients.index')" class="px-3 py-2">Volver</Link>
          <button class="bg-blue-600 text-white px-3 py-2 rounded" :disabled="form.processing">Actualizar</button>
        </div>

        <!-- <div v-if="form.errors" class="col-span-2 text-red-600 text-sm">
          <div v-for="(msg, field) in form.errors" :key="field">{{ msg }}</div>
        </div> -->

        <div v-if="form.hasErrors" class="col-span-2 text-red-600 text-sm">
          <div v-for="(msg, field) in form.hasErrors" :key="field">{{ msg }}</div>
        </div>
      </form>
    </div>
  </AppLayout>
</template>