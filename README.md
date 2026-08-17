<div align="center">

<h1>uxMAX</h1>

<p>
developed and maintained by
<a href="https://www.initmax.com"><img alt="initMAX" src="./.readme/logo/initmax-logo-framed.svg" height="22" valign="middle"></a>
and community
</p>

<p><strong>The Zabbix frontend, adjusted to the way your team actually works.</strong><br>
Colour-coded tags you can read across the room, dashboards without wasted space, a font you can live with, syntax highlighting where you write code - a dozen small changes, one switch each, no forked frontend.</p>

<p>
<img src="./.readme/badge/zabbix.svg" alt="Zabbix 6.0-7.4">
<img src="./.readme/badge/version.svg" alt="version 2.0.1">
<img src="./.readme/badge/php.svg" alt="PHP 7.4+">
<img src="./.readme/badge/free.svg" alt="FREE AGPLv3">
<img src="./.readme/badge/gpg.svg" alt="GPG signed">
</p>

<p>
<a href="#what-you-can-build"><strong>Features</strong></a> &nbsp;·&nbsp;
<a href="#examples"><strong>Examples</strong></a> &nbsp;·&nbsp;
<a href="#install"><strong>Install</strong></a> &nbsp;·&nbsp;
<a href="#free-vs-pro"><strong>FREE vs PRO</strong></a> &nbsp;·&nbsp;
<a href="https://portal.initmax.com"><strong>Portal</strong></a> &nbsp;·&nbsp;
<a href="https://www.initmax.com/wiki/uxmax/"><strong>Docs</strong></a>
</p>

<br>

<img src="./.readme/screen/01-overview.png" width="880" alt="Latest data with tags coloured by rule: red CPU, blue memory, purple disk, orange HTTP service.">

</div>

---

## Why uxMAX

Zabbix is generous with what it monitors and sparing with how you look at it. uxMAX adds the adjustments people end up asking for after a few months of living in the interface - each one a single checkbox in one place, each one reversible, none of them a fork of the frontend.

**Colour tags.** Give a tag prefix a colour and it carries that colour everywhere tags appear - Problems, Hosts, Latest data. On a busy problem list, `service:` in orange and `env:` in grey is the difference between reading and scanning. Rules match on *starts with*, *contains* or *ends with*, and you can let each user layer their own rules on top of the global ones.

**Dashboards without the gaps.** Remove the padding Zabbix reserves around every widget, and hide the header of any widget you have marked "no header" so it stays hidden outside edit mode. On a wall display that is a couple of extra rows.

## What you can build

<table>
<tr>
<td width="50%" valign="top">

**Colour-coded tags**

Rules by starts with / contains / ends with paint tags the same colour everywhere in the frontend.

</td>
<td width="50%" valign="top">

**Per-user rules on top**

Users add their own tag colours without touching the global rule set.

</td>
</tr>
<tr>
<td width="50%" valign="top">

**Sidebar and background colours**

Tell production from staging at a glance - or match the corporate palette.

</td>
<td width="50%" valign="top">

**JavaScript highlighting**

Syntax and expression highlighting in preprocessing and script editors.

</td>
</tr>
<tr>
<td width="50%" valign="top">

**Your own frontend font**

Load a custom font for the whole Zabbix UI.

</td>
<td width="50%" valign="top">

**Draggable, wider modals**

Move dialog windows around and set a minimum modal width for long forms.

</td>
</tr>
</table>

## Examples

<table>
<tr>
<td width="50%" align="center" valign="top"><img src="./.readme/screen/02-configuration.png" alt="Configuration"><br><small><b>Configuration</b> - Configure color-tag rules, compact dashboards, hidden widget headers, draggable dialogs and other interface improvements in one place.</small></td>
<td width="50%" align="center" valign="top"><img src="./.readme/screen/03-latest-data.png" alt="Latest data"><br><small><b>Latest data</b> - A disabled item stays in the list, greyed out and marked D, so nobody hunts for data that is not being collected.</small></td>
</tr>
<tr>
<td width="50%" align="center" valign="top"><img src="./.readme/screen/04-user-preferences.png" alt="User preferences"><br><small><b>User preferences</b> - My uxMAX: each user sees the global colour rules and can layer their own on top when the administrator allows it.</small></td>
</tr>
</table>

## Configuration

Everything lives on one page: **Administration → uxMAX configuration**. Each row is a switch with a plain-English explanation next to it; there is no separate documentation you have to hold in your head.

Users get their own small page under **User settings → My uxMAX**, where they can add colour-tag rules of their own on top of the global ones. Administrators can switch that off, and then the menu entry is not there at all.

## Install

**FREE** ships as **GPG-signed `deb` / `rpm` packages** from the initMAX repository - `apt` / `dnf` installs them and keeps them updated.

### Easiest way - the guided installer on the Portal

Open the product page, pick your **OS** and **edition**, and copy the ready-made command. FREE is fully public (no login); PRO fills in your token once you sign in. There's a feedback box right there too.

<div align="center">
<a href="https://portal.initmax.com/catalog/zabbix-uxmax#how-to-install"><img src="./.readme/screen/portal-installer.png" width="100%" alt="Guided installer on the initMAX Portal - click to open"></a>
</div>

<p align="center"><a href="https://portal.initmax.com/catalog/zabbix-uxmax#how-to-install"><strong>→ Open the installer on the Portal</strong></a></p>

Prefer a plain archive? Every release also ships as a **ZIP** [straight from the repo](https://repo.initmax.com/zabbix/free/zip/uxmax/) - handy for offline or manual installs.

The module is enabled automatically during the package installation - verify it in **Administration → General → Modules**. Done.

## FREE vs PRO

There is no paid edition - everything below is in the one package.

| Feature | FREE |
| ---------------------------------------------------------- | :----: |
| Colour tags by rule - starts with, contains, ends with | ✅ |
| Per-user colour rules on top of the global ones | ✅ |
| Sidebar and background colours | ✅ |
| Syntax and expression highlighting for JavaScript | ✅ |
| Custom frontend font | ✅ |
| Draggable modal windows and a minimum modal width | ✅ |
| Hide widget headers outside edit mode | ✅ |
| Compact dashboard - no gaps between widgets | ✅ |
| Disabled items greyed out in Latest data | ✅ |
| Localised into all 25 Zabbix display languages | ✅ |
| High availability ready | ✅ |
| Licence | AGPLv3 |

## Requirements

|              |                                                              |
| ------------ | ------------------------------------------------------------ |
| **Zabbix**   | 6.0 · 6.2 · 6.4 · 7.0 · 7.2 · 7.4 - one package covers all    |
| **PHP**      | 7.4 or newer                                                 |
| **OS**       | Debian/Ubuntu · RHEL/Rocky/Alma/Oracle/Amazon · SUSE         |
| **Editions** | FREE (public repo) - there is no paid edition                  |
| **Languages** | All 25 Zabbix display languages - the module follows each user's own language setting |
| **High availability** | Ready. Settings live in the Zabbix database (the module's own configuration, and each user's rules in their profile), not on the frontend node, so any node of an HA cluster serves the same thing - install the package on each of them |

### One package, six Zabbix versions

Zabbix changed its module interface at 6.4 and will not load a module built for the other side of that line, so uxMAX carries **both** builds and the package installs the one your frontend accepts. There is nothing to choose and nothing to redo after a Zabbix upgrade: the package switches builds by itself when the frontend version changes.

The settings page is deliberately identical on every supported version - same switches, same order, same wording. Where an older Zabbix cannot do something, uxMAX does the work itself rather than leaving you a control that does nothing:

- **Colour tags** rely on an attribute Zabbix only added in 7.0. On 6.0 - 6.4 uxMAX supplies it, so the rules colour tags there exactly as they do on 7.4.
- **Compact dashboards** and **hidden widget headers** target an element Zabbix renamed in 7.0; both names are styled, so both features work across the range.
- **Draggable modals** hook whichever repositioning method the frontend has - the method was renamed in 7.4.

One honest note on the range: **Zabbix 7.4 already offers draggable modal dialogs of its own.** Leaving uxMAX's version switched on there is harmless (it simply keeps a dragged dialog where you left it), but on 7.4 it is the only setting on the page you may not need.

## Support &amp; links

- **[Documentation / Wiki](https://www.initmax.com/wiki/uxmax/)**
- **[Product page](https://www.initmax.com/product/uxmax/)**
- **[Portal](https://portal.initmax.com)** - downloads, tokens, support tickets
- **Source code (FREE, AGPLv3)** - included in every package and published as a [source archive](https://repo.initmax.com/zabbix/free/zip/uxmax/) on repo.initmax.com
- **[support@initmax.com](mailto:support@initmax.com)**

---

<div align="center">
<sub>FREE: <a href="https://www.gnu.org/licenses/agpl-3.0.html">AGPLv3</a> &nbsp;·&nbsp; © 2021–2026 initMAX s.r.o.</sub>
</div>
