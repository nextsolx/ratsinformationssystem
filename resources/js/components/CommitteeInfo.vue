<script>
export default {
    name: 'CommitteeInfo',
    props: {
        information: {
            type: String,
            default: () => 'info'
        }
    }
};
</script>

<template>
    <div class="ris-committee-info">
        <p class="ris-committee-info__text">{{ information }}</p>
        <div class="ris-committee-info__confirm">
            <h2 class="ris-h2 ris-committee-info__heading">Bürgereingabe</h2>
            <div class="ris-committee-info__wrapper">
                <span />
                <h3 class="ris-committee-info__subheading">
                    „Sie haben ein Anliegen, über das ein politisches Gremium entscheiden soll?“
                </h3>
                <button class="ris-button ris-committee-info__button">Eingabe einreichen</button>
            </div>
        </div>
    </div>
</template>
