<template>
    <div class="wrapper">
        <div>
            <CRow>
                <CCol>
                    <CCard>
                        <CCardHeader>
                            <div class="d-flex justify-content-between">
                                <h2>Jadwal</h2>
                                <div class="d-flex align-items-end">
                                    <div class="mr-2">
                                        Divisi:
                                        <CDropdown 
                                            :toggler-text="selectedDivisi"
                                            color="primary">
                                            <CDropdownItem v-for="divisi in divisions" :key="divisi" @click="selectDivisi(divisi)">{{ divisi }}</CDropdownItem>
                                        </CDropdown>
                                    </div>
                                    <CButton class="flex-0" color="danger" @click="isDelete = !isDelete">Hapus Pegawai</CButton>
                                </div>
                            </div>
                        </CCardHeader>
                        <CCardBody>
                            <table class="table table-bordered w-100 " cellspacing="0" align="center" style="table-layout: fixed">
                                <thead>
                                    <tr class="bg-light text-body">
                                        <td align="center" height="50">
                                            <b>Shift</b>
                                        </td>
                                        <td v-for="hari in daftarHari" :key="hari" align="center" height="50">
                                            <b>{{ hari }}</b>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="center" height="50"><b>07:00 - 14:59</b></td>
                                        <IsiJadwal 
                                            v-for="hari in daftarHari"
                                            :key="'isi-jadwal-'+hari"
                                            :daftarPegawai="daftarJadwal[selectedDivisi][hari][0]"
                                            @toggleModal="() => toggleModal(daftarJadwal[selectedDivisi][hari][0].map(p => p.idPegawai), hari, 1)"
                                            @fetchJadwal="fetchJadwal"
                                            :isDelete="isDelete"/>
                                    </tr>
                                    <tr>
                                        <td align="center" height="50"><b>15:00 - 22:59</b></td>
                                        <IsiJadwal 
                                            v-for="hari in daftarHari"
                                            :key="'isi-jadwal-'+hari"
                                            :daftarPegawai="daftarJadwal[selectedDivisi][hari][1]"
                                            @toggleModal="() => toggleModal(daftarJadwal[selectedDivisi][hari][1].map(p => p.idPegawai), hari, 2)"
                                            @fetchJadwal="fetchJadwal"
                                            :isDelete="isDelete"/>
                                    </tr>
                                    <tr>
                                        <td align="center" height="50"><b>23:00 - 6:59</b></td>
                                        <IsiJadwal 
                                            v-for="hari in daftarHari"
                                            :key="'isi-jadwal-'+hari"
                                            :daftarPegawai="daftarJadwal[selectedDivisi][hari][2]"
                                            @toggleModal="() => toggleModal(daftarJadwal[selectedDivisi][hari][2].map(p => p.idPegawai), hari, 3)"
                                            @fetchJadwal="fetchJadwal"
                                            :isDelete="isDelete"/>
                                    </tr>
                                </tbody>
                            </table>
                        </CCardBody>
                    </CCard>
                </CCol>
            </CRow>
        </div>
        <div>
            <CModal
                title="Tambah Pegawai"
                size="lg"
                :show.sync="modalTambah"
            >
                <CCard>
                    <CCardHeader><b>Daftar Pegawai</b></CCardHeader>
                    <CListGroup flush>
                        <CListGroupItem v-for="pegawai in daftarPegawai" :key="pegawai.id">
                            <div class="d-flex justify-content-between">
                                {{ pegawai.nama }}
                                <div class="bg-primary" @click="addToPegawaiTerpilih(pegawai.id)">
                                    <CIcon name="cil-plus"/>
                                </div>
                            </div>
                        </CListGroupItem>
                        <CListGroupItem v-if="daftarPegawai.length == 0">Tidak ada data</CListGroupItem>
                    </CListGroup>
                </CCard>
                <CCard>
                    <CCardHeader><b>Pegawai Terpilih</b></CCardHeader>
                    <CListGroup flush>
                        <CListGroupItem v-for="pegawai in pegawaiTerpilih" :key="pegawai.id">{{ pegawai.nama }}</CListGroupItem>
                        <CListGroupItem v-if="pegawaiTerpilih.length == 0">Tidak ada data</CListGroupItem>
                    </CListGroup>
                </CCard>
                <template #footer>
                    <CButton @click="modalTambah = false" color="danger">Batal</CButton>
                    <CButton @click="tambahJadwal()" color="success">Tambah Jadwal</CButton>
                </template>
            </CModal>
        </div>
    </div>
</template>

<script>
import IsiJadwal from './IsiJadwal'
import axios from 'axios'

export default {
    name: "JadwalIndex",
    title: 'Jadwal Pegawai',
    components: {
        IsiJadwal,
    },
    data() {
        return {
            selectedDivisi: 'Keamanan',
            divisions: [
                'Kebersihan',
                'Keamanan',
                'Keserasian',
                'Kontrol',
                'Administrasi'
            ],
            daftarJadwal: {
                'Keamanan': {
                    'Senin': [[],[],[]],
                    'Selasa': [[],[],[]],
                    'Rabu': [[],[],[]],
                    'Kamis': [[],[],[]],
                    'Jumat': [[],[],[]],
                    'Sabtu': [[],[],[]],
                    'Minggu': [[],[],[]],
                },
                'Kebersihan': {
                    'Senin': [[],[],[]],
                    'Selasa': [[],[],[]],
                    'Rabu': [[],[],[]],
                    'Kamis': [[],[],[]],
                    'Jumat': [[],[],[]],
                    'Sabtu': [[],[],[]],
                    'Minggu': [[],[],[]],
                },
                'Keserasian': {
                    'Senin': [[],[],[]],
                    'Selasa': [[],[],[]],
                    'Rabu': [[],[],[]],
                    'Kamis': [[],[],[]],
                    'Jumat': [[],[],[]],
                    'Sabtu': [[],[],[]],
                    'Minggu': [[],[],[]],
                },
                'Kontrol': {
                    'Senin': [[],[],[]],
                    'Selasa': [[],[],[]],
                    'Rabu': [[],[],[]],
                    'Kamis': [[],[],[]],
                    'Jumat': [[],[],[]],
                    'Sabtu': [[],[],[]],
                    'Minggu': [[],[],[]],
                },
                'Administrasi': {
                    'Senin': [[],[],[]],
                    'Selasa': [[],[],[]],
                    'Rabu': [[],[],[]],
                    'Kamis': [[],[],[]],
                    'Jumat': [[],[],[]],
                    'Sabtu': [[],[],[]],
                    'Minggu': [[],[],[]],
                },
            },
            daftarHari: [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu',
            ],
            modalTambah: false,
            daftarPegawai: [],
            pegawaiTerpilih:[],
            selectedHari: '',
            selectedShift: 0,
            isDelete: false,
        }
    },
    methods: {
        convertData(data) {
            const converted = {
                'Senin': [[],[],[]],
                'Selasa': [[],[],[]],
                'Rabu': [[],[],[]],
                'Kamis': [[],[],[]],
                'Jumat': [[],[],[]],
                'Sabtu': [[],[],[]],
                'Minggu': [[],[],[]],
            }
            data.forEach(el => {
                converted[el.hari][el.idShift - 1].push({ id: el.id, nama: el.nama, idPegawai: el.idPegawai })
            });
            return converted;
        },
        fetchJadwal() {
            axios.get(this.$apiAdress + '/api/jadwal/' + this.selectedDivisi + '?token=' + localStorage.getItem("api_token"))
            .then(r => {
                this.daftarJadwal[this.selectedDivisi] = this.convertData(r.data)
                console.log('fetch jadwal')
            })
        },
        selectDivisi(divisi) {
            this.selectedDivisi = divisi;
            this.fetchJadwal();
        },
        fetchPegawai(ids) {
            axios.get(this.$apiAdress + '/api/pegawai/divisi/' + this.selectedDivisi + '?token=' + localStorage.getItem("api_token"))
                .then(r => {
                    this.daftarPegawai = r.data.filter(data => !ids.includes(data.id));
                })
        },
        toggleModal(ids, hari, shift) {
            this.modalTambah = !this.modalTambah;
            this.pegawaiTerpilih = [];
            this.selectedHari = hari;
            this.selectedShift = shift;
            this.fetchPegawai(ids);
        },
        addToPegawaiTerpilih(id) {
            const index = this.daftarPegawai.findIndex((pegawai) => pegawai.id == id)
            this.pegawaiTerpilih.push(this.daftarPegawai[index]);
            this.daftarPegawai = this.daftarPegawai.filter((pegawai) => pegawai.id != id);
        },
        tambahJadwal() {
            this.pegawaiTerpilih.forEach(pegawai => {
                const formData = new FormData();
                formData.append('hari', this.selectedHari);
                formData.append('idPegawai', pegawai.id);
                formData.append('idShift', this.selectedShift);
                axios.post(this.$apiAdress + '/api/jadwal/add/', formData).then(r => console.log(formData));
            })
            this.modalTambah = false;
            this.fetchJadwal();
        }
    },
    mounted() {
        this.fetchJadwal();
    },
}
</script>