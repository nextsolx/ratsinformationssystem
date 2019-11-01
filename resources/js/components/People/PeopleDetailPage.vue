<script>
export default {
    name: 'PeopleDetailPage',
    data: () => ({
        activeTab: 'true',
    }),
    methods: {
        openTab(e, dataType) {
            const tabCurrent = e.currentTarget;
            const tabAll = document.querySelectorAll('.ris-tab');
            tabAll.forEach(tab => {
                tab.classList.remove('ris-tab_active');
            });
            tabCurrent.classList.add('ris-tab_active');

            this.displayTabData(dataType);
        },
        displayTabData(dataTypeRef) {
            const tabDataAll = document.querySelectorAll('.ris-tab-data');
            tabDataAll.forEach(tab => {
                tab.classList.remove('ris-tab-data_active');
            });
            this.$refs[dataTypeRef].classList.add('ris-tab-data_active');
        },
    },
};
</script>
