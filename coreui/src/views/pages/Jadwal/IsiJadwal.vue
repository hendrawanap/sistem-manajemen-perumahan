<template>
    <td class="p-2" height="50">
        <CButton color="primary" class="w-100" @click="toggleModal"><div class="d-flex align-items-center text-truncate"><CIcon class="mr-2" name="cil-plus"/> Tambah Pegawai</div></CButton>
        <div 
            class="border bg-secondary d-flex px-2 py-2 mt-2 rounded-sm justify-content-between align-items-center flex-nowrap"
            :class="[isDelete ? 'is-delete' : '']"
            v-for="(pegawai, index) in daftarPegawaiTop"
            :key="'pegawai-top-' + index"
        >
            <div class="text-truncate">{{ pegawai.nama }}</div>
            <div class="flex-shrink-0" @click="deleteJadwal(pegawai)" v-if="isDelete" color="primary"><CIcon name="cil-trash" :height="16" :width="16"/></div>
        </div>
        <template v-if="isMore">
            <div 
                class="border bg-secondary d-flex px-2 py-2 mt-2 rounded-sm justify-content-between align-items-center flex-nowrap"
                :class="[isDelete ? 'is-delete' : '']"
                v-for="(pegawai, index) in daftarPegawaiMore"
                :key="'pegawai-more-' + index"
            >
                <div class="text-truncate">{{ pegawai.nama }}</div>
                <div class="flex-shrink-0" @click="deleteJadwal(pegawai)" v-if="isDelete" color="primary"><CIcon name="cil-trash" :height="16" :width="16"/></div>
            </div>
        </template>
        <CButton v-if="daftarPegawai.length > 3" color="warning" class="w-100 mt-2" @click="isMore = !isMore"><div class="text-truncate">{{isMore ? "Hide" : "Show More"}}</div></CButton>
    </td>
</template>

<script>
import axios from 'axios'
export default {
    name: 'IsiJadwal',
    data() {
        return {
            isMore: false,
        }
    },
    props: ['daftarPegawai', 'isDelete'],
    computed: {
        daftarPegawaiTop() {
            if (this.daftarPegawai.length > 3) {
                return this.daftarPegawai.slice(0,3)
            }
            return this.daftarPegawai
        },
        daftarPegawaiMore() {
            if (this.daftarPegawai.length > 3) {
                return this.daftarPegawai.slice(3,this.daftarPegawai.length)
            }
            return []
        }
    },
    methods: {
        toggleModal() {
            this.$emit("toggleModal")
        },
        deleteJadwal(jadwal) {
            axios.delete(this.$apiAdress + '/api/jadwal/' + jadwal.id + '?token=' + localStorage.getItem('api_token')).then(r => this.$emit("deleteJadwal", r.data.message))
        }
    }
}
</script>

<style scoped>
    .is-delete:hover {
        background-color: var(--danger);
    }
</style>