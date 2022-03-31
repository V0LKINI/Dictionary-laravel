<section id="resetExperienceSection" class="resetExperienceSection" hidden>
    <form action="{{ route('resetDaily') }}" method="post">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <input class="admin__button button-danger" type="submit" value="Сбросить ежедневный опыт">
    </form>

    <form action="{{ route('resetWeekly') }}" method="post">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <input class="admin__button button-danger" type="submit" value="Сбросить недельный опыт">
    </form>

    <form action="{{ route('resetMonthly') }}" method="post">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <input class="admin__button button-danger" type="submit" value="Сбросить месячный опыт">
    </form>
</section>