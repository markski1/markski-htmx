Who's to blame and when does it matter
July 6, 2025
Up to what point is someone else's fault not your fault?

---

### Origin

After a recent outage of Google Cloud Services, and the domino effect it brought along, [a post on X by Dane Knetch](https://x.com/dok2001/status/1933272215396688124/), the CTO of Cloudflare, regarding the effects of the outage on their platform, acknoweldges the following:

> At the end of the day we are responsible for our availability.

### Dilemma

A vendor can be the cause of an outage. It is not a reasonable expectation for a company to have complete physical access and control of their infra, if any at all, especially at Startup level.

It is not the decision of a company's costumers for any infrastructure to be dependant on a specific cloud. However it is also not their engineers' fault that a given cloud would fail to maintain service.

### Nobody ever got fired for buying IBM

A well known, old-school phrase to signify cynicism around a fact: The safe expensive choice is what one is borderline forced to lean into, if they wish to keep their neck untouched above all else when it comes to business purchase decisions. 

Nowadays, this is probably either Amazon, Google or Microsoft. None of the above can assure truly perfect service availability, however. Not even due to incompetence, there's a million variables that can make things stop working and not one single entity is in control of them all.

### Mitigations

There's a bit of a logical order of things to follow.

#### Multiple instances
I tend to oppose the general microservices and "serverless" trend and terminology, but some of the base bulletpoints around this is fairly solid: Your applications should ideally be able to "live" in multiple places at once, load balanced. Or, at the very least, have some sort of watchdog, capable of detecting failures or downtime and "respawn" them elsewhere.

#### Multiple regions
Cloud providers usually fail at "availability zone" level. Different providers use different names for this. Within a region you should have your services spread across separate AZ's. A 'region' as a whole can fail, though, for technical or physical reasons: Regional catastrophes, acts of god, infrastructural failure (ie. prolonged loss of power).

It would help, then, to be able to serve from different places in the world. There is a joke that if Amazon's "us-east-1" disappears, so does quite a bit of the world. This is funny. However, if this is true for your organization, perhaps try and plan around it.

To properly serve off separate regions in an efficient manner can be hard. One could go into a whole tangent about the often-ignored consecuences of separating data and compute, and to keep data up to date in many places at once is a science of its own, but at the very least: You should be able to failover to other regions without requiring all hands on deck.

#### Multiple providers: 

Quite extreme, but possibly what should be "the goal": To have multiple vendors makes the possibility of suffering downtime because of a vendor a borderline non-factor.

The practical problems from this are cruel, though: Inter-cloud networking will be slower than within a cloud, almost always. To set up private tunnels between them can be a bit of a devops nightmare. To manage all of this at once can be a nightmare of it's own. And the cost of inter-cloud bandwidth can be a straight up deal breaker for most smaller orgs, not to mention the cost of the infra itself.

However, the "multiple providers" rule can be applied wider than just compute providers: If you use a third party service for, say, transactional emails, what happens if the one you use fails? Would it be reasonable to have two such providers and an internal failover layer for mailing? How about payment gateways? LLM completions?

Either way...

### Redundancy

The name of the game is *the magic of having two of them*. Or more. The entire point around this post is that to rely on a single vendor for anything means that you limit yourself to the competence of the vendor.

When problems arise once or twice a blue moon it can be acceptable to blame the vendor. They should uphold their SLA after all. But your customers will not care, especially when a issue becomes recurrent.

If your budget is thin and your service reflects this, a little bit of downtime -can- be the acceptable trade-off. To comply with everything above can make the cost of operating very expensive and it may simply not make sense. But at the end of the day...

You chose the vendor. You should hold yourself accountable if you're not doing enough to work around their shit.