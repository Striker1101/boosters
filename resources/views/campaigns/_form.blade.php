@php
    $campaign = $campaign ?? null;

    $field = 'w-full px-4 py-2.5 text-sm text-white bg-slate-950 border border-white/10 rounded-lg focus:border-indigo-500 focus:ring-0 placeholder:text-slate-600';
    $label = 'block mb-2 text-xs font-bold tracking-widest text-slate-400 uppercase';
    $hint = 'mt-2 text-xs text-slate-500';
@endphp

<div class="space-y-6">
    <div>
        <label class="{{ $label }}" for="name">Campaign name</label>
        <input id="name" name="name" type="text" required value="{{ old('name', $campaign?->name) }}"
            placeholder="e.g. Q3 finance team awareness test" class="{{ $field }}">
    </div>

    <div>
        <label class="{{ $label }}" for="platform">Lure theme</label>
        <select id="platform" name="platform" required class="{{ $field }}">
            @foreach ($platforms as $key => $theme)
                <option value="{{ $key }}" @selected(old('platform', $campaign?->platform) === $key)>
                    {{ $theme['label'] }}
                </option>
            @endforeach
        </select>
        <p class="{{ $hint }}">
            Themes use our own generic wording, colours and icons. They deliberately do not reproduce any
            company's logo or page design.
        </p>
    </div>

    <div>
        <label class="{{ $label }}" for="scope">Scope and purpose</label>
        <textarea id="scope" name="scope" rows="3" required
            placeholder="Which group is in scope, how they were told about the exercise, and what the results will be used for."
            class="{{ $field }}">{{ old('scope', $campaign?->scope) }}</textarea>
        <p class="{{ $hint }}">Minimum 20 characters. This is part of the authorization record.</p>
    </div>

    <fieldset class="p-5 space-y-4 border rounded-xl bg-white/5 border-white/10">
        <legend class="px-2 text-xs font-bold tracking-widest uppercase text-amber-300">
            Authorization record
        </legend>

        <p class="text-xs text-slate-400">
            A campaign cannot be activated without a named authorizer. Only a super admin can switch a campaign
            to active, and only while this sign-off is current.
        </p>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="{{ $label }}" for="authorized_by">Authorized by (name and role)</label>
                <input id="authorized_by" name="authorized_by" type="text" required
                    value="{{ old('authorized_by', $campaign?->authorized_by) }}"
                    placeholder="e.g. R. Mokoena, Head of Security" class="{{ $field }}">
            </div>

            <div>
                <label class="{{ $label }}" for="authorized_email">Authorizer email</label>
                <input id="authorized_email" name="authorized_email" type="email" required
                    value="{{ old('authorized_email', $campaign?->authorized_email) }}"
                    placeholder="security@example.com" class="{{ $field }}">
            </div>

            <div>
                <label class="{{ $label }}" for="authorization_ref">Authorization reference</label>
                <input id="authorization_ref" name="authorization_ref" type="text" required
                    value="{{ old('authorization_ref', $campaign?->authorization_ref) }}"
                    placeholder="Ticket, policy or memo reference" class="{{ $field }}">
            </div>

            <div>
                <label class="{{ $label }}" for="authorization_expires_at">Authorization expires</label>
                <input id="authorization_expires_at" name="authorization_expires_at" type="date" required
                    value="{{ old('authorization_expires_at', $campaign?->authorization_expires_at?->format('Y-m-d')) }}"
                    class="{{ $field }}">
            </div>
        </div>
    </fieldset>
</div>
