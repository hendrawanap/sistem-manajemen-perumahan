<template>
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
                                    <CDropdownItem v-for="divisi in divisions" :key="divisi" @click="selectedDivisi = divisi">{{ divisi }}</CDropdownItem>
                                </CDropdown>
                            </div>
                            <CButton class="flex-0" color="danger">Hapus Pegawai</CButton>
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
                                <td align="center" height="50">
                                    <b>Senin</b>
                                </td>
                                <td align="center" height="50">
                                    <b>Selasa</b>
                                </td>
                                <td align="center" height="50">
                                    <b>Rabu</b>
                                </td>
                                <td align="center" height="50">
                                    <b>Kamis</b>
                                </td>
                                <td align="center" height="50">
                                    <b>Jumat</b>
                                </td>
                                <td align="center" height="50">
                                    <b>Sabtu</b>
                                </td>
                                <td align="center" height="50">
                                    <b>Minggu</b>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center" height="50"><b>07:00 - 14:59</b></td>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].senin.shift_1"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].selasa.shift_1"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].rabu.shift_1"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].kamis.shift_1"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].jumat.shift_1"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].sabtu.shift_1"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].minggu.shift_1"/>
                            </tr>
                            <tr>
                                <td align="center" height="50"><b>15:00 - 22:59</b></td>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].senin.shift_2"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].selasa.shift_2"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].rabu.shift_2"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].kamis.shift_2"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].jumat.shift_2"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].sabtu.shift_2"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].minggu.shift_2"/>
                            </tr>
                            <tr>
                                <td align="center" height="50"><b>23:00 - 6:59</b></td>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].senin.shift_3"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].selasa.shift_3"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].rabu.shift_3"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].kamis.shift_3"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].jumat.shift_3"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].sabtu.shift_3"/>
                                <IsiJadwal :daftarPegawai="daftarJadwal[selectedDivisi.toLowerCase()].minggu.shift_3"/>
                            </tr>
                        </tbody>
                    </table>
                </CCardBody>
            </CCard>
        </CCol>
    </CRow>
</template>

<script>
import IsiJadwal from './IsiJadwal'
import daftarJadwal from './dummy'
import Axios from 'axios'

export default {
    name: "JadwalIndex",
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
            daftarJadwal
        }
    },
    methods: {

    },
    mounted() {
        Axios.get(this.$apiAdress + '/api/getUser?token=' + localStorage.getItem("api_token")).then(r => console.log(r.data))
    },
}
</script>