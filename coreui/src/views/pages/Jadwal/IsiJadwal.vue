<template>
    <td class="p-2" height="50">
        <CButton color="primary" class="w-100"><div class="text-truncate"><CIcon name="cil-plus" color="white"/>Tambah Pegawai</div></CButton>
        <div class="border bg-secondary text-truncate px-1 py-2 mt-2" v-for="(pegawai, index) in daftarPegawaiTop" :key="'pegawai-' + index">{{ pegawai }}</div>
        <template v-if="isMore">
            <div class="border bg-secondary text-truncate px-1 py-2 mt-2" v-for="(pegawai, index) in daftarPegawaiMore" :key="'pegawai-' + index">{{ pegawai }}</div>
        </template>
        <CButton v-if="daftarPegawai.length > 3" color="warning" class="w-100 mt-2" @click="isMore = !isMore"><div class="text-truncate">{{isMore ? "Hide" : "Show More"}}</div></CButton>
    </td>
</template>

<script>
export default {
    name: 'IsiJadwal',
    data() {
        return {
            isMore: false,
        }
    },
    props: ['daftarPegawai'],
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
    }
}
</script>