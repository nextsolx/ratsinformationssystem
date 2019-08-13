<script>
import Sorting from '../Ux/Sorting';

export default {
    name: 'CommitteeSessions',
    components: {
        Sorting
    },
};
</script>

<template>
    <div class="ris-committee-sessions">
        <Sorting class="ris-committee-sessions__sorting ris-without-padding-mob" :input-hidden-mob="true" />
        <h2 class="ris-h2 ris-committee-sessions__heading">2018 (6 Sitzungen)</h2>
    </div>
</template>
