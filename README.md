# Awareness Console

A security-awareness platform for running **authorized** phishing-simulation
exercises against enrolled participants, and measuring how they respond.

It is built to answer the question *"how do our people behave when someone tries
this?"* without ever becoming a tool that collects credentials.

---

## The one rule

**Nothing a participant types is ever stored.**

This is enforced by the schema and by the request handling, not by convention:

| Layer | Guarantee |
|---|---|
| Schema | There is no column in any table able to hold a submitted secret. |
| Form | The credential inputs carry no `name` attribute, so the browser never puts their values in the request body. A typed password does not leave the device. |
| Controller | `SimulationController::submit()` reads only a boolean and strips the credential fields before any other code runs. |
| Audit log | `SimulationEvent::record()` filters its `meta` payload through a strict allow-list, so submitted values cannot reach the log even by accident. |
| Flow | Submitting sends the participant **straight to a debrief**. There is no second attempt, no password re-prompt, and no 2FA capture step. |

`tests/Feature/SimulationSafetyTest.php` pins all of this down, including a test
that dumps every value in every table and asserts the submitted secret is absent.

If you are about to add a feature that stores, forwards, or displays something a
participant typed: **don't.** That is the line this project exists on the right
side of.

---

## Controls that keep exercises scoped

- **Authorization record.** A campaign carries a named authorizer, their email, a
  reference, a written scope, and an expiry date. A campaign cannot be activated
  without a complete, unexpired record — enforced in `Campaign::isAuthorized()`
  and in `CampaignController::updateStatus()`.
- **Two roles.** An `admin` runs campaigns and sees only their own. A
  `super_admin` approves authorizations, flips campaigns live, and manages staff.
  Only a super admin can change a campaign's status.
- **Enrolment only.** A lure is served only to someone on the participant list,
  via their own unguessable token. Any other request gets a 404. This is what
  stops a link from being sprayed at the public.
- **No public sign-up.** Staff accounts are created by a super admin, which keeps
  the tag namespace closed.
- **Private console.** Every non-simulation route requires a signed-in account.
  `/` redirects guests to the login.
- **Throttling.** The public simulation endpoints are rate limited so tokens
  cannot be enumerated.
- **Preview isolation.** An owner can walk the funnel with `?preview=1`, and
  nothing they do is counted.

---

## How an exercise runs

1. **Create a campaign** — name, a generic lure theme, and the authorization
   record.
2. **Enrol participants** — one at a time, or paste a list. Each gets a personal
   link.
3. **Super admin activates it** — after checking the authorization record.
4. **Read the results** — aggregate rates only.

A participant's path: personal link → lure → simulated sign-in → **immediate
debrief** explaining the exercise, what gave it away, and how to report it.

### Metrics

| Metric | Meaning |
|---|---|
| Open rate | The message was viewed. |
| Click rate | The participant acted on it. Treat as your training baseline. |
| Submit rate | They typed something into the form. **Lower is better.** |
| Report rate | They flagged it. **This is the number to grow.** |
| Resilience | `(not submitted + reported) / total`. Higher is better. |

---

## Lure themes

Themes live in `config/lures.php` and are deliberately **generic**: our own
wording, icons and colours, with the platform named only in body text. They do
not reproduce any company's logo, wordmark or page design, because impersonating
a brand is both a trademark problem and the thing that makes a page real
phishing rather than a simulation.

---

## Roles and tags

Every account gets a unique tag, generated on creation
(`User::generateTag()`). The tag identifies which admin a campaign belongs to, so
results attribute to the right dashboard. Tags can be rotated; existing links
keep working but stop being attributed to the old tag.

---

## Local development

```bash
composer install
npm install
php artisan migrate
php artisan db:seed      # super admin, admin, and a demo campaign
npm run dev              # or: npm run build
php artisan serve --port=8001
```

Seeded accounts:

| Email | Password | Role |
|---|---|---|
| `owner@example.com` | `password` | super_admin |
| `admin@example.com` | `password` | admin |

The seeder creates one **active demo campaign** with three participants so the
funnel can be walked immediately. Delete it before running a real exercise.

## Tests

```bash
php artisan test
```

The suite covers authentication, the campaign lifecycle, role boundaries, and the
safety invariants described above.

## Legacy

`logs` and `tags` remain from the previous order-based schema. The `password`
column was **dropped** and is not restorable through a rollback. `Log` and `Tag`
are kept only so nothing breaks; new work belongs in `Campaign`,
`CampaignTarget`, and `SimulationEvent`.
