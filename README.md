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
<img src="./.readme/badge/version.svg" alt="version 2.0.0">
<img src="./.readme/badge/php.svg" alt="PHP 7.4+">
<img src="./.readme/badge/free.svg" alt="FREE AGPLv3">
<img src="./.readme/badge/gpg.svg" alt="GPG signed">
</p>

<p>
<a href="#what-it-does"><strong>What it does</strong></a> &nbsp;·&nbsp;
<a href="#configuration"><strong>Configuration</strong></a> &nbsp;·&nbsp;
<a href="#install"><strong>Install</strong></a> &nbsp;·&nbsp;
<a href="#requirements"><strong>Requirements</strong></a> &nbsp;·&nbsp;
<a href="https://portal.initmax.com"><strong>Portal</strong></a> &nbsp;·&nbsp;
<a href="https://www.initmax.com/wiki/uxmax/"><strong>Docs</strong></a>
</p>

<br>

<img src="./.readme/screen/uxMAX.png" width="880" alt="Coloured tags, a recoloured sidebar and syntax-highlighted JavaScript in a Zabbix frontend running uxMAX">

</div>

---

## What it does

Zabbix is generous with what it monitors and sparing with how you look at it. uxMAX adds the adjustments people end up asking for after a few months of living in the interface - each one a single checkbox in one place, each one reversible, none of them a fork of the frontend.

**Colour tags.** Give a tag prefix a colour and it carries that colour everywhere tags appear - Problems, Hosts, Latest data. On a busy problem list, `service:` in orange and `env:` in grey is the difference between reading and scanning. Rules match on *starts with*, *contains* or *ends with*, and you can let each user layer their own rules on top of the global ones.

**Dashboards without the gaps.** Remove the padding Zabbix reserves around every widget, and hide the header of any widget you have marked "no header" so it stays hidden outside edit mode. On a wall display that is a couple of extra rows.

**Interface behaviour.** Drag modal dialogs by their title bar - and they stay where you put them, instead of snapping back the next time Zabbix repositions them. Set a minimum width for modals that are too narrow for their content. Show disabled items in Latest data, greyed out with a marker, instead of pretending they do not exist.

**Appearance.** Recolour the page background and the sidebar - the quickest way to tell four Zabbix instances apart at a glance - and load your own font, from a Google Fonts URL or an uploaded font file, applied across the whole interface.

**Syntax highlighting.** JavaScript in script items and preprocessing steps, and Zabbix expressions in triggers and calculated items, get a real editor with highlighting instead of a plain textarea. Pick the font and size.

## Configuration

Everything lives on one page: **Administration → uxMAX configuration**. Each row is a switch with a plain-English explanation next to it; there is no separate documentation you have to hold in your head.

<img src="./.readme/screen/02-configuration.png" width="880" alt="The uxMAX configuration page, with each setting explained beside it">

Users get their own small page under **User settings → My uxMAX**, where they can add colour-tag rules of their own on top of the global ones. Administrators can switch that off, and then the menu entry is not there at all.

### Disabled items in Latest data

<img src="./.readme/screen/03-latest-data.png" width="880" alt="Latest data listing a disabled item greyed out with a D marker">

## Install

The module ships as a **GPG-signed `deb` / `rpm` package** from the initMAX repository - `apt` / `dnf` installs it and keeps it updated.

### Easiest way - the guided installer on the Portal

Open the product page, pick your **OS**, and copy the ready-made command. It is fully public, no login needed. There's a feedback box right there too.

<p align="center"><a href="https://portal.initmax.com/catalog/zabbix-uxmax#how-to-install"><strong>→ Open the installer on the Portal</strong></a></p>

Prefer a plain archive? Every release also ships as a **ZIP** [straight from the repo](https://repo.initmax.com/zabbix/free/zip/uxmax/) - handy for offline or manual installs.

Then enable it in **Administration → General → Modules**. Done - the configuration page appears under Administration.

## Requirements

|              |                                                              |
| ------------ | ------------------------------------------------------------ |
| **Zabbix**   | 6.0 · 6.2 · 6.4 · 7.0 · 7.2 · 7.4 - one package covers all    |
| **PHP**      | 7.4 or newer                                                 |
| **OS**       | Debian/Ubuntu · RHEL/Rocky/Alma/Oracle/Amazon · SUSE         |
| **Edition**  | FREE - there is no paid edition of this module               |
| **Languages** | Localised into all 25 Zabbix display languages - the settings page follows the language each user has chosen |
| **High availability** | Ready. Settings live in the Zabbix database (the module's own configuration, and each user's rules in their profile), not on the frontend node, so any node of an HA cluster serves the same thing - install the package on each of them |

### One package, six Zabbix versions

Zabbix changed its module interface at 6.4 and will not load a module built for the other side of that line, so uxMAX carries **both** builds and the package installs the one your frontend accepts. There is nothing to choose and nothing to redo after a Zabbix upgrade: the package switches builds by itself when the frontend version changes.

The settings page is deliberately identical on every supported version - same switches, same order, same wording. Where an older Zabbix cannot do something, uxMAX does the work itself rather than leaving you a control that does nothing:

- **Colour tags** rely on an attribute Zabbix only added in 7.0. On 6.0 - 6.4 uxMAX supplies it, so the rules colour tags there exactly as they do on 7.4.
- **Compact dashboards** and **hidden widget headers** target an element Zabbix renamed in 7.0; both names are styled, so both features work across the range.
- **Draggable modals** hook whichever repositioning method the frontend has - the method was renamed in 7.4.

One honest note on the range: **Zabbix 7.4 already offers draggable modal dialogs of its own.** Leaving uxMAX's version switched on there is harmless (it simply keeps a dragged dialog where you left it), but on 7.4 it is the only setting on the page you may not need.

## Support &amp; links

- 📚 **[Documentation / Wiki](https://www.initmax.com/wiki/uxmax/)**
- 🛒 **[Product page](https://www.initmax.com/product/uxmax/)**
- 🎫 **[Portal](https://portal.initmax.com)** - downloads, support tickets
- 💾 **Source code** (AGPLv3) - included in every package and published as a [source archive](https://repo.initmax.com/zabbix/free/zip/uxmax/) on repo.initmax.com
- ✉️ **[support@initmax.com](mailto:support@initmax.com)**

---

<div align="center">
<sub><a href="https://www.gnu.org/licenses/agpl-3.0.html">AGPLv3</a> &nbsp;·&nbsp; © 2021-2026 initMAX s.r.o.</sub>
</div>
